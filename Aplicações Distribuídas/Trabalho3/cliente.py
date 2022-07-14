"""
Aplicações Distribuídas - Projeto 3 - client.py
Grupo: 14
Números de aluno: 55853, 56935
"""

import requests 
import json


while True:

    comando = input("comando > ")

    lista_comando = comando.strip().split()

    if lista_comando[0] == "EXIT":
        print("Vai fechar a ligação")
        exit() 

    if lista_comando[0] not in ["CREATE", "READ", "DELETE", "UPDATE"]:
        print("O comando inserido não existe")
    
    else:
        
        if len(lista_comando) < 2:
            print("Introduziu argumentos a menos")
        
        else:
            ####### CREATE ########
            if lista_comando[0] == "CREATE":

                if lista_comando[1] not in ["UTILIZADOR", "ARTISTA", "MUSICA"]:
                    
                    # CREATE <id_user> <id_musica> <avaliacao>
                    if lista_comando[1].isnumeric() and lista_comando[2].isnumeric() and lista_comando[3].isnumeric() == False:

                        if len(lista_comando) < 4:
                            print("Introduziu argumentos a menos, o comando deve ser do tipo: \n"
                                "CREATE <id_user> <id_musica> <avaliacao>")
                        
                        elif len(lista_comando) > 4:
                            print("Introduziu argumentos a mais, o comando deve ser do tipo: \n"
                                "CREATE <id_user> <id_musica> <avaliacao>")

                        else:
                            dados_playlist = {"id_user" : lista_comando[1], "id_musica" : lista_comando[2], "avaliacao" : lista_comando[3]}
                            r = requests.post('http://localhost:5000/musicas/avaliacoes', json=dados_playlist)
                            print ("Status: " + str(r.status_code))
                            print (r.content.decode())
                            print (r.headers)
                            print ('***')

                    else:
                        print("O comando inserido não existe")
                
                else:

                    ####### UTILIZADOR ########
                    if lista_comando[1] == "UTILIZADOR":

                        if len(lista_comando) < 4:
                            print("Introduziu argumentos a menos, o comando deve ser do tipo: \n"
                                "CREATE UTILIZADOR <nome> <senha>")
                        
                        elif len(lista_comando) > 4:
                            print("Introduziu argumentos a mais, o comando deve ser do tipo: \n"
                                "CREATE UTILIZADOR <nome> <senha>")

                        else:
                            dados_utilizador = {"nome": lista_comando[2], "senha" : lista_comando[3]}
                            r = requests.post('http://localhost:5000/utilizadores/', json=dados_utilizador)
                            print ("Status: " + str(r.status_code))
                            print (r.content.decode())
                            print (r.headers)
                            print ('***')


                    ####### ARTISTA ########
                    elif lista_comando[1] == "ARTISTA":
                        if len(lista_comando) < 3:
                            print("Introduziu argumentos a menos, o comando deve ser do tipo: \n"
                                "CREATE ARTISTA <id_spotify>")
                        
                        elif len(lista_comando) > 3:
                            print("Introduziu argumentos a mais, o comando deve ser do tipo: \n"
                                "CREATE ARTISTA <id_spotify>")

                        else:
                            dados_artista = {"id_spotify" : lista_comando[2]}
                            r = requests.post('http://localhost:5000/artistas/', json=dados_artista)
                            print ("Status: " + str(r.status_code))
                            print (r.content.decode())
                            print (r.headers)
                            print ('***')


                    ####### MUSICA ########
                    elif lista_comando[1] == "MUSICA":
                        if len(lista_comando) < 3:
                            print("Introduziu argumentos a menos, o comando deve ser do tipo: \n"
                                "CREATE MUSICA <id_spotify>")
                        
                        elif len(lista_comando) > 3:
                            print("Introduziu argumentos a mais, o comando deve ser do tipo: \n"
                                "CREATE MUSICA <id_spotify>")

                        else:
                            dados_musica = {"id_spotify" : lista_comando[2]}
                            r = requests.post('http://localhost:5000/musicas/', json=dados_musica)
                            print ("Status: " + str(r.status_code))
                            print (r.content.decode())
                            print (r.headers)
                            print ('***')

                        
                
            ####### READ ########
            if lista_comando[0] == "READ":

                if lista_comando[1] not in ["UTILIZADOR", "ARTISTA", "MUSICA", "ALL"]:
                    print("O comando inserido não existe")
                
                ####### UTILIZADOR ########
                if lista_comando[1] == "UTILIZADOR":
                    if len(lista_comando) < 3:
                        print("Introduziu argumentos a menos, o comando deve ser do tipo: \n"
                            "READ UTILIZADOR <id_user>")
                    
                    elif len(lista_comando) > 3:
                        print("Introduziu argumentos a mais, o comando deve ser do tipo: \n"
                            "READ UTILIZADOR <id_user>")

                    else:
                        dados_utilizador = {"id_user" : lista_comando[2]} 
                        dados_json = json.dumps(dados_utilizador)
                        r = requests.get('http://localhost:5000/utilizadores/' + str(lista_comando[2]), json=dados_json)
                        print ("Status: " + str(r.status_code))
                        print (r.content.decode())
                        print (r.headers)
                        print ('***')
                

                ####### ARTISTA ########
                elif lista_comando[1] == "ARTISTA":
                    if len(lista_comando) < 3:
                        print("Introduziu argumentos a menos, o comando deve ser do tipo: \n"
                            "READ ARTISTA <id_artista>")
                    
                    elif len(lista_comando) > 3:
                        print("Introduziu argumentos a mais, o comando deve ser do tipo: \n"
                            "READ ARTISTA <id_artista>")

                    else:
                        r = requests.get('http://localhost:5000/artistas/' + str(lista_comando[2]))
                        print ("Status: " + str(r.status_code))
                        print (r.content.decode())
                        print (r.headers)
                        print ('***')


                ####### MUSICA ########
                elif lista_comando[1] == "MUSICA":
                    if len(lista_comando) < 3:
                        print("Introduziu argumentos a menos, o comando deve ser do tipo: \n"
                            "READ MUSICA <id_musica>")
                    
                    elif len(lista_comando) > 3:
                        print("Introduziu argumentos a mais, o comando deve ser do tipo: \n"
                            "READ MUSICA <id_musica>")

                    else:
                        r = requests.get('http://localhost:5000/musicas/' + str(lista_comando[2]))
                        print ("Status: " + str(r.status_code))
                        print (r.content.decode())
                        print (r.headers)
                        print ('***')

                
                ####### ALL ########
                elif lista_comando[1] == "ALL":

                    if lista_comando[2] not in ["UTILIZADORES", "ARTISTAS", "MUSICAS", "MUSICAS_A", "MUSICAS_U"]:
                        print("O comando inserido não existe")

                    if len(lista_comando) < 3:
                        print("Introduziu argumentos a menos, o comando deve ser do tipo: \n"
                            "READ ALL < UTILIZADORES | ARTISTAS | MUSICAS>")
                    
                    elif len(lista_comando) > 3 and (lista_comando[2] != "MUSICAS" and lista_comando[2] != "MUSICAS_A" and lista_comando[2] != "MUSICAS_U"):
                        print("Introduziu argumentos a mais, o comando deve ser do tipo: \n"
                            "READ ALL < UTILIZADORES | ARTISTAS | MUSICAS> ou \n"
                            "DELETE ALL MUSICAS_A <id_artista> ou \n"
                            "DELETE ALL MUSICAS_U <id_user>") 
  
                    else:
                        ####### ALL UTILIZADORES ########
                        if lista_comando[2] == "UTILIZADORES":

                            r = requests.get('http://localhost:5000/utilizadores/all/')
                            print ("Status: " + str(r.status_code))
                            print (r.content.decode())
                            print (r.headers)
                            print ('***')
                        
                        ####### ALL ARTISTAS ########
                        if lista_comando[2] == "ARTISTAS":
                
                            r = requests.get('http://localhost:5000/artistas/all/')
                            print ("Status: " + str(r.status_code))
                            print (r.content.decode())
                            print (r.headers)
                            print ('***')

                        ####### ALL MUSICAS ########
                        if lista_comando[2] == "MUSICAS":

                            if len(lista_comando) == 3:
        
                                r = requests.get('http://localhost:5000/musicas/all/')
                                print ("Status: " + str(r.status_code))
                                print (r.content.decode())
                                print (r.headers)
                                print ('***')

                            elif len(lista_comando) == 4:
                                
                                ####### ALL MUSICAS AVALIACAO ########
                                if lista_comando[3] not in ["M", "m", "S", "B", "MB"]:
                                    print("Introduziu argumentos a mais, o comando deve ser do tipo: \n"
                                        "READ ALL MUSICAS ou READ ALL MUSICAS < M | m | S | B | MB >")
                                else:
                                    dados_avaliacao = {"avaliacao" : lista_comando[3]} 
                                    r = requests.get('http://localhost:5000/musicas/all/avaliacoes/', json=dados_avaliacao)
                                    print ("Status: " + str(r.status_code))
                                    print (r.content.decode())
                                    print (r.headers)
                                    print ('***')
                    
                        
                         ####### ALL MUSICAS_A ########
                        if lista_comando[2] == "MUSICAS_A":
                            if len(lista_comando) < 4:
                                print("Introduziu argumentos a menos, o comando deve ser do tipo: \n"
                                    "READ ALL MUSICAS_A <id_artista>")
                            
                            elif len(lista_comando) > 4:
                                print("Introduziu argumentos a mais, o comando deve ser do tipo: \n"
                                    "READ ALL MUSICAS_A <id_artista>")

                            else:
                                r = requests.get('http://localhost:5000/musicas/all/artista/' + str(lista_comando[3]))
                                print ("Status: " + str(r.status_code))
                                print (r.content.decode())
                                print (r.headers)
                                print ('***')


                         ####### ALL MUSICAS_U ########
                        if lista_comando[2] == "MUSICAS_U":
                            if len(lista_comando) < 4:
                                print("Introduziu argumentos a menos, o comando deve ser do tipo: \n"
                                    "READ ALL MUSICAS_U <id_user>")
                            
                            elif len(lista_comando) > 4:
                                print("Introduziu argumentos a mais, o comando deve ser do tipo: \n"
                                    "READ ALL MUSICAS_U <id_user>")

                            else:
                                r = requests.get('http://localhost:5000/musicas/all/utilizador/' + str(lista_comando[3]))
                                print ("Status: " + str(r.status_code))
                                print (r.content.decode())
                                print (r.headers)
                                print ('***')


            ####### DELETE ########
            if lista_comando[0] == "DELETE":

                if lista_comando[1] not in ["UTILIZADOR", "ARTISTA", "MUSICA", "ALL"]:
                    print("O comando inserido não existe")

                ####### UTILIZADOR ########
                if lista_comando[1] == "UTILIZADOR":
                    if len(lista_comando) < 3:
                        print("Introduziu argumentos a menos, o comando deve ser do tipo: \n"
                            "DELETE UTILIZADOR <id_user>")
                    
                    elif len(lista_comando) > 3:
                        print("Introduziu argumentos a mais, o comando deve ser do tipo: \n"
                            "DELETE UTILIZADOR <id_user>")

                    else:
                        r = requests.delete('http://localhost:5000/utilizadores/' + str(lista_comando[2]))
                        print ("Status: " + str(r.status_code))
                        print (r.content.decode())
                        print (r.headers)
                        print ('***')
                

                ####### ARTISTA ########
                elif lista_comando[1] == "ARTISTA":
                    if len(lista_comando) < 3:
                        print("Introduziu argumentos a menos, o comando deve ser do tipo: \n"
                            "DELETE ARTISTA <id_artista>")
                    
                    elif len(lista_comando) > 3:
                        print("Introduziu argumentos a mais, o comando deve ser do tipo: \n"
                            "DELETE ARTISTA <id_artista>")

                    else:
                        r = requests.delete('http://localhost:5000/artistas/' + str(lista_comando[2]))
                        print ("Status: " + str(r.status_code))
                        print (r.content.decode())
                        print (r.headers)
                        print ('***')


                ####### MUSICA ########
                elif lista_comando[1] == "MUSICA":
                    if len(lista_comando) < 3:
                        print("Introduziu argumentos a menos, o comando deve ser do tipo: \n"
                            "DELETE MUSICA <id_musica>")
                    
                    elif len(lista_comando) > 3:
                        print("Introduziu argumentos a mais, o comando deve ser do tipo: \n"
                            "DELETE MUSICA <id_musica>")

                    else:
                        r = requests.delete('http://localhost:5000/musicas/' + str(lista_comando[2]))
                        print ("Status: " + str(r.status_code))
                        print (r.content.decode())
                        print (r.headers)
                        print ('***')

                ####### DELETE ALL ########
                elif lista_comando[1] == "ALL":
                    if len(lista_comando) < 3:
                        print("Introduziu argumentos a menos, o comando deve ser do tipo: \n"
                            "DELETE ALL < UTILIZADORES | ARTISTAS | MUSICAS>")
                    
                    elif len(lista_comando) > 3 and (lista_comando[2] != "MUSICAS" and lista_comando[2] != "MUSICAS_A" and lista_comando[2] != "MUSICAS_U"):
                        print("Introduziu argumentos a mais, o comando deve ser do tipo: \n"
                            "READ ALL < UTILIZADORES | ARTISTAS | MUSICAS> ou \n"
                            "DELETE ALL MUSICAS_A <id_artista> ou \n"
                            "DELETE ALL MUSICAS_U <id_user>") 

                    else:
                        ####### ALL UTILIZADORES ########
                        if lista_comando[2] == "UTILIZADORES":
                            if len(lista_comando) < 3:
                                print("Introduziu argumentos a menos, o comando deve ser do tipo: \n"
                                    "DELETE ALL UTILIZADORES")
                            
                            elif len(lista_comando) > 3:
                                print("Introduziu argumentos a mais, o comando deve ser do tipo: \n"
                                    "DELETE ALL UTILIZADORES")

                            else:
                                r = requests.delete('http://localhost:5000/utilizadores/all/')
                                print ("Status: " + str(r.status_code))
                                print (r.content.decode())
                                print (r.headers)
                                print ('***')
                        
                        ####### ALL ARTISTAS ########
                        if lista_comando[2] == "ARTISTAS":
                            if len(lista_comando) < 3:
                                print("Introduziu argumentos a menos, o comando deve ser do tipo: \n"
                                    "DELETE ALL ARTISTAS")
                            
                            elif len(lista_comando) > 3:
                                print("Introduziu argumentos a mais, o comando deve ser do tipo: \n"
                                    "DELETE ALL ARTISTAS")

                            else:
                                r = requests.delete('http://localhost:5000/artistas/all/')
                                print ("Status: " + str(r.status_code))
                                print (r.content.decode())
                                print (r.headers)
                                print ('***')
                        

                        ####### ALL MUSICAS ########
                        if lista_comando[2] == "MUSICAS":
                            if len(lista_comando) < 3:
                                print("Introduziu argumentos a menos, o comando deve ser do tipo: \n"
                                    "DELETE ALL MUSICAS ou DELETE ALL MUSICAS <avaliacao>")
                            
                            elif len(lista_comando) > 4:
                                print("Introduziu argumentos a mais, o comando deve ser do tipo: \n"
                                    "DELETE ALL MUSICAS ou DELETE ALL MUSICAS <avaliacao>")

                            else:
                                if len(lista_comando) == 3:
            
                                    r = requests.delete('http://localhost:5000/musicas/all/')
                                    print ("Status: " + str(r.status_code))
                                    print (r.content.decode())
                                    print (r.headers)
                                    print ('***')

                                ####### ALL MUSICAS AVALIACAO ########
                                elif len(lista_comando) == 4:
                                    
                                    dados_avaliacao = {"avaliacao" : lista_comando[3]}
                                    r = requests.delete('http://localhost:5000/musicas/all/avaliacoes/', json=dados_avaliacao)
                                    print ("Status: " + str(r.status_code))
                                    print (r.content.decode())
                                    print (r.headers)
                                    print ('***')
                

                        ####### ALL MUSICAS_A ########
                        if lista_comando[2] == "MUSICAS_A":
                            if len(lista_comando) < 4:
                                print("Introduziu argumentos a menos, o comando deve ser do tipo: \n"
                                    "DELETE ALL MUSICAS_A <id_artista>")
                            
                            elif len(lista_comando) > 4:
                                print("Introduziu argumentos a mais, o comando deve ser do tipo: \n"
                                    "DELETE ALL MUSICAS_A <id_artista>")

                            else:
                                r = requests.delete('http://localhost:5000/musicas/all/artista/' + str(lista_comando[3]))
                                print ("Status: " + str(r.status_code))
                                print (r.content.decode())
                                print (r.headers)
                                print ('***')


                        ####### ALL MUSICAS_U ########
                        if lista_comando[2] == "MUSICAS_U":
                            if len(lista_comando) < 4:
                                print("Introduziu argumentos a menos, o comando deve ser do tipo: \n"
                                    "DELETE ALL MUSICAS_U <id_user>")
                            
                            elif len(lista_comando) > 4:
                                print("Introduziu argumentos a mais, o comando deve ser do tipo: \n"
                                    "DELETE ALL MUSICAS_U <id_user>")

                            else:
                                r = requests.delete('http://localhost:5000/musicas/all/utilizador/' + str(lista_comando[3]))
                                print ("Status: " + str(r.status_code))
                                print (r.content.decode())
                                print (r.headers)
                                print ('***')


            ####### UPDATE ########
            if lista_comando[0] == "UPDATE":
                
                if lista_comando[1] not in ["UTILIZADOR", "MUSICA"]:
                    print("O comando inserido não existe")


                ####### UTILIZADOR ########
                if lista_comando[1] == "UTILIZADOR":
                    if len(lista_comando) < 4:
                        print("Introduziu argumentos a menos, o comando deve ser do tipo: \n"
                            "UPDATE UTILIZADOR <id_user> <password>")
                        
                    elif len(lista_comando) > 4:
                        print("Introduziu argumentos a mais, o comando deve ser do tipo: \n"
                            "UPDATE UTILIZADOR <id_user> <password>")

                    else:
                        dados_utilizador = {"id": lista_comando[2], "senha" : lista_comando[3]}
                        r = requests.put('http://localhost:5000/utilizadores/', json=dados_utilizador)
                        print ("Status: " + str(r.status_code))
                        print (r.content.decode())
                        print (r.headers)
                        print ('***')


                ####### MUSICA ########
                if lista_comando[1] == "MUSICA":
                    if len(lista_comando) < 5:
                            print("Introduziu argumentos a menos, o comando deve ser do tipo: \n"
                                "UPDATE MUSICA <id_musica> <avaliacao> <id_user>")
                        
                    elif len(lista_comando) > 5:
                        print("Introduziu argumentos a mais, o comando deve ser do tipo: \n"
                            "UPDATE MUSICA <id_musica> <avaliacao> <id_user>")

                    else:
                        dados_playlist = {"id_musica" : lista_comando[2], "avaliacao" : lista_comando[3], "id_user" : lista_comando[4]}
                        r = requests.put('http://localhost:5000/musicas/avaliacoes', json=dados_playlist)
                        print ("Status: " + str(r.status_code))
                        print (r.content.decode())
                        print (r.headers)
                        print ('***')