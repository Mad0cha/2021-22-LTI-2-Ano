"""
Aplicações Distribuídas - Projeto 4 - servidor.py
Grupo: 14
Números de aluno: 55853, 56935
"""

import requests
from flask import Flask, request, make_response, redirect, url_for, jsonify
import sqlite3
from os.path import isfile
import json
from requests_oauthlib import OAuth2Session
import ssl

# A preencher com os dados desejados
client_id = '...'
client_secret = '...'

redirect_uri= 'https://localhost:5000/callback'
spotify = OAuth2Session(client_id, redirect_uri=redirect_uri)

app = Flask(__name__)

# Conexao da base de dados 
def connect_db(dbname):
    db_is_created = isfile(dbname) # Existe ficheiro da base de dados?
    connection = sqlite3.connect('projeto3.db')
    cursor = connection.cursor()
    if not db_is_created:
        with app.open_resource('projeto3.sql', mode='r') as file_sql:
            connection.cursor().executescript(file_sql.read())
        connection.commit()
    cursor.execute('PRAGMA foreign_keys = ON;')
    return connection, cursor


@app.route('/', methods = ["GET"])
def home():
    return 'Hello World!'


@app.route('/login', methods = ["GET"])
def login():
    authorization_base_url = 'https://accounts.spotify.com/authorize'
    authorization_url, state = spotify.authorization_url(authorization_base_url)
    return redirect(authorization_url)

@app.route('/callback', methods = ["GET"])
def callback():
    token_url = 'https://accounts.spotify.com/api/token'
    spotify.fetch_token(token_url,client_secret=client_secret,authorization_response=request.url)
    return redirect(url_for('.profile'))

@app.route("/profile", methods=["GET"])
def profile():
    protected_resource = 'https://api.spotify.com/v1/me'
    return jsonify(spotify.get(protected_resource).json())


@app.route('/utilizadores/', methods = ["POST", "PUT"])
@app.route('/utilizadores/<int:id>', methods = ["GET", "DELETE"])
@app.route('/utilizadores/all/', methods = ["GET", "DELETE"])

# UTILIZADORES #####################################################################################################
def utilizadores(id = None):
    
    conn, cursor = connect_db('projeto3.db')

    # CREATE UTILIZADOR
    if request.method == "POST":

        if request.url == "https://localhost:5000/utilizadores/":
            dados_cliente = json.loads(request.data)
            dados_db = (dados_cliente["nome"], dados_cliente["senha"])

            cursor.execute('INSERT INTO utilizadores(nome, senha) VALUES (?, ?)', dados_db)
            conn.commit()
            r = make_response("O utilizador " + str(dados_db[0]) + " foi criado com sucesso!") 
            r.status_code = 201

            cursor.execute("SELECT id FROM utilizadores WHERE nome = ?", (dados_db[0],))
            id = cursor.fetchone()
            r.headers['location'] = 'http://localhost:5000/utilizadores/'+ str(id[0])
            conn.close()
            return r

    # UPDATE UTILIZADOR
    if request.method == "PUT":
  
        if request.url == "https://localhost:5000/utilizadores/":
            dados_cliente = json.loads(request.data)

            cursor.execute("SELECT id FROM utilizadores WHERE id = ?", (dados_cliente["id"],))
            resultado = cursor.fetchall()

            if resultado == []:
                erro = json.dumps({'describedBy':"https://localhost:5000/suporte/", 'httpStatus':'404', 'title':"O utilizador com id " + dados_cliente["id"] + " não existe"})
                r = make_response(erro)
                r.status_code = 404

            else:
                cursor.execute('UPDATE utilizadores SET senha=? WHERE id = ?', (dados_cliente["senha"],dados_cliente["id"]))
                conn.commit()
                r = make_response("A password do utilizador com id = " + dados_cliente["id"] + " foi atualizada com sucesso!") 
                r.headers['location'] = 'https://localhost:5000/utilizadores/'+ dados_cliente["id"]
       
            conn.close()
            return r

    # READ UTILIZADOR
    if request.method == "GET":

        # READ UTILIZADOR <id_user>
        if request.url == "https://localhost:5000/utilizadores/" + str(id):
            
            cursor.execute('SELECT * FROM utilizadores WHERE id=?', (str(id),))
            user = cursor.fetchone()
            
            if user is not None:
                r = make_response(json.dumps(user))
            else:
                erro = json.dumps({'describedBy':"https://localhost:5000/suporte/", 'httpStatus':'404', 'title':'O utilizador com id = ' + str(id) + ' não existe!'})
                r = make_response(erro)
                r.status_code = 404
            conn.close()
            return r
            
        
        # READ ALL < UTILIZADORES >
        if request.url == "https://localhost:5000/utilizadores/all/":

            cursor.execute('SELECT * FROM utilizadores')
            users = cursor.fetchall()

            if users != []:
                r = make_response(json.dumps(users))

            else:
                erro = json.dumps({'describedBy':"https://localhost:5000/suporte/", 'httpStatus':'404', 'title':'Ainda não existem utilizadores!'})
                r = make_response(erro)
                r.status_code = 404
                
            conn.close()
            return r

    # DELETE UTILIZADOR
    if request.method == "DELETE":

        # DELETE UTILIZADOR <id_user>
        if request.url == "https://localhost:5000/utilizadores/" + str(id):
            cursor.execute('SELECT * FROM utilizadores WHERE id=?', (str(id),))
            users = cursor.fetchall()

            if users != []:
                cursor.execute('DELETE FROM utilizadores WHERE id=?', (str(id),))
                conn.commit()
                r = make_response("O utilizador com id = " + str(id) + " foi eliminado com sucesso!")

            else:
                erro = json.dumps({'describedBy':"https://localhost:5000/suporte/", 'httpStatus':'404', 'title':'O utilizador com id = ' + str(id) + ' não existe!'})
                r = make_response(erro)
                r.status_code = 404

            conn.close()
            return r

        # DELETE ALL UTILIZADORES
        if request.url == "https://localhost:5000/utilizadores/all/":
            
            cursor.execute('SELECT * FROM utilizadores')
            users = cursor.fetchall()

            if users != []:
                cursor.execute('DELETE FROM utilizadores')
                conn.commit()
                r = make_response("Todos os utilizadores foram eliminados com sucesso!")

            else:
                erro = json.dumps({'describedBy':"https://localhost:5000/suporte/", 'httpStatus':'404', 'title':'Ainda não existem utilizadores!'})
                r = make_response(erro)
                r.status_code = 404

            conn.close()
            return r

####################################################################################################################


@app.route('/artistas/', methods = ["POST"])
@app.route('/artistas/<int:id>', methods = ["GET", "DELETE"])
@app.route('/artistas/all/', methods = ["GET", "DELETE"])
def artistas(id = None):

    conn, cursor = connect_db('projeto3.db')

    # CREATE ARTISTA 
    if request.method == "POST":

        if request.url == "https://localhost:5000/artistas/":
            dados_cliente = json.loads(request.data)
            dados_spotify = spotify.get("https://api.spotify.com/v1/artists/" + dados_cliente["id_spotify"]).json()
            
            try:
                
                cursor.execute("SELECT id_spotify FROM artistas WHERE id_spotify = ?", (dados_cliente["id_spotify"],))
                conn.commit()
                resultado = cursor.fetchall()

                if resultado != []:
                    r = make_response("O artista com o id " + dados_cliente["id_spotify"] + " no spotify já existe")

                else:
                    dados_db = (dados_cliente["id_spotify"], dados_spotify["name"])
                    cursor.execute("INSERT INTO artistas (id_spotify, nome) VALUES (?,?)", dados_db)
                    conn.commit()
                    r = make_response("O artista " + str(dados_db[1]) + " com o id " + dados_db[0] + " no spotify foi inserido com sucesso!")
                    r.status_code = 201

                    cursor.execute("SELECT id FROM artistas WHERE id_spotify = ?", (dados_db[0],))
                    id = cursor.fetchall()
                    r.headers['location'] = "https://localhost:5000/artistas/" + str(id)

            except KeyError:
                r = make_response(dados_spotify)
                r.status_code = dados_spotify["error"]["status"]

            conn.close()
            return r
            
    # READ ARTISTA
    if request.method == "GET":

        # READ ARTISTA <id_artista>
        if request.url == "https://localhost:5000/artistas/" + str(id):
            cursor.execute("SELECT * FROM artistas WHERE id = ?", (str(id),))
            row = cursor.fetchone()
           
            if row is not None:
                dados_spotify = spotify.get("https://api.spotify.com/v1/artists/" + row[1]).json()
                r = make_response(dados_spotify)

                if "error" in dados_spotify:
                    r.status_code = dados_spotify["error"]["status"]

            else:
                erro = json.dumps({'describedBy':"https://localhost:5000/suporte/", 'httpStatus':'404', 'title':'O artista com id = ' + str(id) + ' não existe!'})
                r = make_response(erro)
                r.status_code = 404

            conn.close()
            return r
        
        # READ ALL ARTISTAS
        if request.url == "https://localhost:5000/artistas/all/":
            cursor.execute("SELECT * FROM artistas")
            rows = cursor.fetchall()

            if rows != []:
                r = make_response(json.dumps(rows))

            else:
                erro = json.dumps({'describedBy':"https://localhost:5000/suporte/", 'httpStatus':'404', 'title':'Ainda não existem artistas!'})
                r = make_response(erro)
                r.status_code = 404

            conn.close()
            return r

            
    # DELETE ARTISTA
    if request.method == "DELETE":

        # DELETE ARTISTA <id_artista>
        if request.url == "https://localhost:5000/artistas/" + str(id):
            cursor.execute("SELECT * FROM artistas WHERE id = ?", (str(id),))
            row = cursor.fetchone()
            
            if row is not None:
                cursor.execute("DELETE FROM artistas WHERE id = ?", (str(id),))
                conn.commit()
                r = make_response("O artista com id = " + str(id) + " foi eliminado com sucesso!")
            else: 
                erro = json.dumps({'describedBy':"https://localhost:5000/suporte/", 'httpStatus':'404', 'title':'O artista com id = ' + str(id) + ' não existe!'})
                r = make_response(erro)
                r.status_code = 404

            conn.close()
            return r

        # DELETE ALL ARTISTAS
        if request.url == "https://localhost:5000/artistas/all/":
            cursor.execute("SELECT * FROM artistas")
            rows = cursor.fetchall()

            if rows != []:
                cursor.execute("DELETE FROM artistas")
                conn.commit()
                r = make_response("Todos os artistas foram eliminados com sucesso!")

            else:
                erro = json.dumps({'describedBy':"https://localhost:5000/suporte/", 'httpStatus':'404', 'title':'Ainda não existem artistas!'})
                r = make_response(erro)
                r.status_code = 404

            
            conn.close()
            return r

####################################################################################################################

@app.route('/musicas/', methods = ["POST"])
@app.route('/musicas/avaliacoes', methods = ["POST", "PUT"])
@app.route('/musicas/<int:id>', methods = ["GET", "DELETE"])
@app.route('/musicas/all/', methods = ["GET", "DELETE"])
@app.route('/musicas/all/artista/<int:id>', methods = ["GET", "DELETE"])
@app.route('/musicas/all/utilizador/<int:id>', methods = ["GET", "DELETE"])
@app.route('/musicas/all/avaliacoes/', methods = ["GET", "DELETE"])
def musicas(id = None):

    conn, cursor = connect_db('projeto3.db')

    # CREATE MUSICA
    if request.method == "POST":
        if request.url == "https://localhost:5000/musicas/":
            dados_cliente = json.loads(request.data)
            dados_spotify = spotify.get("https://api.spotify.com/v1/tracks/" + dados_cliente["id_spotify"]).json()
           
            try:
                cursor.execute("SELECT id FROM artistas WHERE id_spotify = ?", (dados_spotify["album"]["artists"][0]["id"],))
                id_artista = cursor.fetchone()

                if id_artista is None:
                    dados_db_artista = (dados_spotify["album"]["artists"][0]["id"], dados_spotify["album"]["artists"][0]["name"])
                    cursor.execute("INSERT INTO artistas (id_spotify, nome) VALUES (?,?)", dados_db_artista)
                    conn.commit()
                    
                    cursor.execute("SELECT id FROM artistas WHERE id_spotify = ?", (dados_spotify["album"]["artists"][0]["id"],))
                    id_artista = cursor.fetchone()
                
                cursor.execute("SELECT id_spotify FROM musicas WHERE id_spotify = ?", (dados_cliente["id_spotify"],))
                conn.commit()
                resultado = cursor.fetchall()

                if resultado != []:
                    r = make_response("A música com o id " + dados_cliente["id_spotify"] + " no spotify já existe")

                else:
                    dados_db = (dados_cliente["id_spotify"], dados_spotify["name"] , id_artista[0])
                    cursor.execute("INSERT INTO musicas (id_spotify, nome, id_artista) VALUES (?,?,?)", dados_db)
                    conn.commit()
                    r = make_response("A música " + str(dados_db[1]) + " com o id " + dados_db[0] + " no spotify foi inserida com sucesso!")
                    r.status_code = 201
                    
                    cursor.execute("SELECT id FROM musicas WHERE id_spotify = ?", (dados_db[0],))
                    id = cursor.fetchall()
                    r.headers['location'] = "https://localhost:5000/musicas/" + str(id[0][0])
            
            except KeyError:
                r = make_response(dados_spotify)
                r.status_code = dados_spotify["error"]["status"]

            conn.close()
            return r

        # CREATE <id_user> <id_musica> <avaliacao>
        if request.url == "https://localhost:5000/musicas/avaliacoes":

            try:
                dados_cliente = json.loads(request.data)
                cursor.execute("SELECT id FROM avaliacoes WHERE sigla = ?", (dados_cliente["avaliacao"],))
                id_avaliacao = cursor.fetchone()

                if id_avaliacao is None:
                    erro = json.dumps({'describedBy':"https://localhost:5000/suporte/", 'httpStatus':'404', 'title':'A avaliação ' + dados_cliente["avaliacao"] + ' não existe'})
                    r = make_response(erro)
                    r.status_code = 404
                else:
                    dados_db = (dados_cliente["id_user"],dados_cliente["id_musica"],id_avaliacao[0])
                    cursor.execute("INSERT INTO playlists (id_user, id_musica, id_avaliacao) VALUES (?,?,?)", dados_db)
                    conn.commit()
                    r = make_response("A avaliação foi inserida com sucesso!")
                    r.status_code = 201

                conn.close()
                return r

            except sqlite3.IntegrityError:
                cursor.execute("SELECT id FROM utilizadores WHERE id = ?", (dados_cliente["id_user"],))
                id_user = cursor.fetchone()
                if id_user is None:
                    erro = json.dumps({'describedBy':"https://localhost:5000/suporte/", 'httpStatus':'404', 'title':'O utilizador com id = ' + str(dados_cliente["id_user"]) + ' não existe!'})
                    r = make_response(erro)
                    r.status_code = 404
                else: 
                    cursor.execute("SELECT id FROM musicas WHERE id = ?", (dados_cliente["id_musica"],))
                    id_musica = cursor.fetchone()
                    if id_musica is None:
                        erro = json.dumps({'describedBy':"https://localhost:5000/suporte/", 'httpStatus':'404', 'title':'A música com id = ' + str(dados_cliente["id_musica"]) + ' não existe!'})
                        r = make_response(erro)
                        r.status_code = 404
                    else:
                        erro = json.dumps({'describedBy':"https://localhost:5000/suporte/", 'httpStatus':'409', 'title':'O utilizador já avaliou essa música!'})
                        r = make_response(erro)
                        r.status_code = 409
                conn.close()
                return r


    # UPDATE MUSICA 
    if request.method == "PUT": 
        if request.url == "https://localhost:5000/musicas/avaliacoes":
            dados_cliente = json.loads(request.data)
            cursor.execute("SELECT id_user, id_musica FROM playlists WHERE id_user = ? AND id_musica = ?", (dados_cliente["id_user"], dados_cliente["id_musica"]))
            row = cursor.fetchone()
     
            # Se o utilizador não tiver avaliado a música
            if row is None:
                erro = json.dumps({'describedBy':"https://localhost:5000/suporte/", 'httpStatus':'404', 'title':'Não existe nenhuma avaliação para a música pretendida por esse utilizador'})
                r = make_response(erro)
                r.status_code = 404
 
            else:
                cursor.execute("SELECT id FROM avaliacoes WHERE sigla = ?", (dados_cliente["avaliacao"],))
                id_avaliacao = cursor.fetchone()
                
                # Se a avaliação não existir
                if id_avaliacao is None:
                    erro = json.dumps({'describedBy':"https://localhost:5000/suporte/", 'httpStatus':'404', 'title':'A avaliação ' + dados_cliente["avaliacao"] + ' não existe'})
                    r = make_response(erro)
                    r.status_code = 404
                else:

                    cursor.execute("UPDATE playlists SET id_avaliacao = ? WHERE id_user = ? AND id_musica = ?", (id_avaliacao[0], dados_cliente["id_user"], dados_cliente["id_musica"]))
                    conn.commit()
                    r = make_response("A avaliação foi atualizada com sucesso!")

            conn.close()
            return r

    # READ MUSICA 
    if request.method == "GET":

        # READ MUSICA <id_musica>
        if request.url == "https://localhost:5000/musicas/" + str(id):
            cursor.execute("SELECT * FROM musicas WHERE id = ?", (str(id),))
            row = cursor.fetchone()
            
            if row is not None:
                dados_spotify = spotify.get("https://api.spotify.com/v1/tracks/" + row[1]).json()
                r = make_response(dados_spotify)

                if "error" in dados_spotify:
                    r.status_code = dados_spotify["error"]["status"]

            else:
                erro = json.dumps({'describedBy':"https://localhost:5000/suporte/", 'httpStatus':'404', 'title':'A musica com id = ' + str(id) + ' não existe!'})
                r = make_response(erro)
                r.status_code = 404

            conn.close()
            return r
        
        # READ ALL MUSICAS 
        if request.url == "https://localhost:5000/musicas/all/":
            cursor.execute("SELECT * FROM musicas")
            rows = cursor.fetchall()

            if rows != []:
                r = make_response(json.dumps(rows))

            else:
                erro = json.dumps({'describedBy':"https://localhost:5000/suporte/", 'httpStatus':'404', 'title':'Ainda não existe nenhuma musica!'})
                r = make_response(erro)
                r.status_code = 404

            conn.close()
            return r

        # READ ALL MUSICAS_A <id_artista>
        if request.url == "https://localhost:5000/musicas/all/artista/" + str(id):
            cursor.execute("SELECT * FROM artistas WHERE id = ?", (str(id),))
            row = cursor.fetchone()
           
            if row is not None:
                cursor.execute("SELECT m.id, m.id_spotify, m.nome, m.id_artista, a.sigla FROM playlists p, musicas m, avaliacoes a WHERE p.id_musica = m.id AND p.id_avaliacao = a.id AND m.id_artista = ?", (str(id),))
                musicas = cursor.fetchall()
                if musicas != []:
                    r = make_response(json.dumps(musicas))
                else:
                    erro = json.dumps({'describedBy':"https://localhost:5000/suporte/", 'httpStatus':'404', 'title':'O artista com id = ' + str(id) + ' não tem nenhuma musica avaliada!'})
                    r = make_response(erro)
                    r.status_code = 404


            else:
                erro = json.dumps({'describedBy':"https://localhost:5000/suporte/", 'httpStatus':'404', 'title':'O artista com id = ' + str(id) + ' não existe!'})
                r = make_response(erro)
                r.status_code = 404
            

            conn.close()
            return r

        # READ ALL MUSICAS_U <id_user>
        if request.url == "https://localhost:5000/musicas/all/utilizador/" + str(id):
            cursor.execute("SELECT m.id, m.id_spotify, m.nome, m.id_artista, a.sigla FROM playlists p, musicas m, avaliacoes a WHERE p.id_musica = m.id AND p.id_avaliacao = a.id AND p.id_user = ?", (str(id),))
            musicas = cursor.fetchall()
            if musicas != []:
                r = make_response(json.dumps(musicas))

            else:
                cursor.execute('SELECT * FROM utilizadores WHERE id=?', (str(id),))
                users = cursor.fetchall()

                if users == []:
                    erro = json.dumps({'describedBy':"https://localhost:5000/suporte/", 'httpStatus':'404', 'title':'O utilizador com id = ' + str(id) + ' não existe!'})
                    r = make_response(erro)
                    r.status_code = 404

                else:
                    erro = json.dumps({'describedBy':"https://localhost:5000/suporte/", 'httpStatus':'404', 'title':'Não existe nenhuma música avaliada pelo o utilizador com id = ' + str(id) })
                    r = make_response(erro)
                    r.status_code = 404

            conn.close()
            return r

        # READ ALL MUSICAS <avaliacao>
        if request.url == "https://localhost:5000/musicas/all/avaliacoes/":
            dados_cliente = json.loads(request.data)
            cursor.execute("SELECT id FROM avaliacoes WHERE sigla = ?", (dados_cliente["avaliacao"],))
            id_avaliacao = cursor.fetchone()

            if id_avaliacao is None:
                erro = json.dumps({'describedBy':"https://localhost:5000/suporte/", 'httpStatus':'404', 'title':'A avaliação ' + dados_cliente["avaliacao"] + ' não existe'})
                r = make_response(erro)
                r.status_code = 404

            else:
                cursor.execute("SELECT m.id, m.id_spotify, m.nome, m.id_artista FROM playlists p, musicas m WHERE p.id_musica = m.id AND p.id_avaliacao = ?", (id_avaliacao[0],))
                musicas = cursor.fetchall()
                if musicas != []:
                    r = make_response(json.dumps(musicas))

                else:
                    erro = json.dumps({'describedBy':"https://localhost:5000/suporte/", 'httpStatus':'404', 'title':'Não existe nenhuma música avaliada com ' + dados_cliente["avaliacao"] })
                    r = make_response(erro)
                    r.status_code = 404

            conn.close()
            return r
            

    # DELETE MUSICA
    if request.method == "DELETE":

        # DELETE MUSICA <id_musica>
        if request.url == "https://localhost:5000/musicas/" + str(id):
            cursor.execute("SELECT id_spotify FROM musicas WHERE id = ?", (str(id),))
            id_spotify = cursor.fetchone()

            if id_spotify is None:
                erro = json.dumps({'describedBy':"https://localhost:5000/suporte/", 'httpStatus':'404', 'title':'A música com id = ' + str(id) + ' não existe!'})
                r = make_response(erro)
                r.status_code = 404

            else: 
                cursor.execute("DELETE FROM musicas WHERE id = ?", (str(id),))
                conn.commit()
                r = make_response("A musica com id = " + str(id) + " foi eliminada com sucesso!")

            conn.close()
            return r
    
        # DELETE ALL MUSICAS
        if request.url == "https://localhost:5000/musicas/all/":
            cursor.execute("SELECT * FROM musicas")
            rows = cursor.fetchall()

            if rows != []:
                cursor.execute("DELETE FROM musicas")
                conn.commit()
                r = make_response("Todas as musicas foram eliminadas com sucesso!")

            else:
                erro = json.dumps({'describedBy':"https://localhost:5000/suporte/", 'httpStatus':'404', 'title':'Ainda não existem musicas!'})
                r = make_response(erro)
                r.status_code = 404

            conn.close()
            return r

        # DELETE ALL MUSICAS_A <id_artista>
        if request.url == "https://localhost:5000/musicas/all/artista/" + str(id):
            cursor.execute("SELECT * FROM artistas WHERE id = ?", (str(id),))
            row = cursor.fetchone()
           
            if row is not None:
            
                cursor.execute("SELECT m.id FROM playlists p, musicas m WHERE p.id_musica = m.id AND m.id_artista = ?", (str(id),))
                musicas = cursor.fetchall()

                if musicas != []:
                    cursor.execute('DELETE FROM musicas WHERE id in ({0})'.format(', '.join('?' for _ in musicas)), list(map(lambda n: n[0], musicas)))
                    conn.commit()
                    r = make_response("Todas as musicas avaliadas do artista com o id = " + str(id) + " foram elimindas com sucesso")
                
                else:
                    erro = json.dumps({'describedBy':"https://localhost:5000/suporte/", 'httpStatus':'404', 'title':"O artista com o id = " + str(id) + " não tem músicas avaliadas"})
                    r = make_response(erro)
                    r.status_code = 404

            else:
                erro = json.dumps({'describedBy':"https://localhost:5000/suporte/", 'httpStatus':'404', 'title':'O artista com id = ' + str(id) + ' não existe!'})
                r = make_response(erro)
                r.status_code = 404

            
            conn.close()
            return r

        # DELETE ALL MUSICAS_U <id_user>
        if request.url == "https://localhost:5000/musicas/all/utilizador/" + str(id):
            cursor.execute("SELECT m.id FROM playlists p, musicas m WHERE p.id_musica = m.id AND p.id_user = ?", (str(id),))
            musicas = cursor.fetchall()

            if musicas != []:
                cursor.execute('DELETE FROM musicas WHERE id in ({0})'.format(', '.join('?' for _ in musicas)), list(map(lambda n: n[0], musicas)))
                conn.commit()
                r = make_response("Todas as musicas avaliadas pelo utilizador com o id = " + str(id) + " foram elimindas com sucesso")
            

            else:
                cursor.execute('SELECT * FROM utilizadores WHERE id=?', (str(id),))
                users = cursor.fetchall()

                if users == []:
                    erro = json.dumps({'describedBy':"https://localhost:5000/suporte/", 'httpStatus':'404', 'title':'O utilizador com id = ' + str(id) + ' não existe!'})
                    r = make_response(erro)
                    r.status_code = 404

                else:
                    erro = json.dumps({'describedBy':"https://localhost:5000/suporte/", 'httpStatus':'404', 'title':"O utilizador com o id = " + str(id) + " ainda não avaliou nenhuma música"})
                    r = make_response(erro)
                    r.status_code = 404
            
            conn.close()
            return r
            
        # DELETE ALL MUSICAS <avaliacao>
        if request.url == "https://localhost:5000/musicas/all/avaliacoes/":
            dados_cliente = json.loads(request.data)
            cursor.execute("SELECT id FROM avaliacoes WHERE sigla = ?", (dados_cliente["avaliacao"],))
            id_avaliacao = cursor.fetchone()

            if id_avaliacao is None:
                erro = json.dumps({'describedBy':"https://localhost:5000/suporte/", 'httpStatus':'404', 'title':'A avaliação ' + dados_cliente["avaliacao"] + ' não existe'})
                r = make_response(erro)
                r.status_code = 404
            
            else:
                cursor.execute("SELECT m.id FROM playlists p, musicas m WHERE p.id_musica = m.id AND p.id_avaliacao = ?", (id_avaliacao[0],))
                musicas = cursor.fetchall()
                if musicas != []:
                    cursor.execute('DELETE FROM musicas WHERE id in ({0})'.format(', '.join('?' for _ in musicas)), list(map(lambda n: n[0], musicas)))
                    conn.commit()
                    r = make_response("Todas as musicas avalidadas com " + dados_cliente["avaliacao"] + " foram elimindas com sucesso")
                else:
                    erro = json.dumps({'describedBy':"https://localhost:5000/suporte/", 'httpStatus':'404', 'title':'Não existe nenhuma música avaliada com ' + dados_cliente["avaliacao"] })
                    r = make_response(erro)
                    r.status_code = 404

            conn.close()
            return r



if __name__ == '__main__':
    context = ssl.SSLContext(protocol=ssl.PROTOCOL_TLS_SERVER)
    context.verify_mode = ssl.CERT_REQUIRED
    context.load_verify_locations(cafile='../certs/root.pem')
    context.load_cert_chain(certfile='../certs/serv.crt',keyfile='../certs/serv.key')
    app.run('localhost', ssl_context=context, debug = True)
    


