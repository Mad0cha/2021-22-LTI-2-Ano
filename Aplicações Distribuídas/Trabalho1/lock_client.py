#!/usr/bin/python
# -*- coding: utf-8 -*-
"""
Aplicações Distribuídas - Projeto 1 - lock_client.py
Grupo: 14
Números de aluno: 55853, 56935
"""

# Zona para fazer imports
import net_client, sys, time

###############################################################################
# Programa principal

def valida_comandos(comando):

    comando_separado = comando.split(" ")
    lista_comando = comando_separado[0].split("-") + comando_separado[1:]

    # LOCK
    if lista_comando[0] == "LOCK":
        if len(lista_comando) < 4:
            return "MISSING ARGUMENTS"
        elif len(lista_comando) > 4:
            return "TOO MANY ARGUMENTS"
        else:
            return "VALID COMMAND"

    # UNLOCK
    if lista_comando[0] == "UNLOCK":
        if len(lista_comando) < 3:
            return "MISSING ARGUMENTS"
        elif len(lista_comando) > 3:
            return "TOO MANY ARGUMENTS"
        else:
            return "VALID COMMAND"

    # STATUS
    if lista_comando[0] == "STATUS":
        if len(lista_comando) < 2:
            return "MISSING ARGUMENTS"
        elif len(lista_comando) > 2:
            return "TOO MANY ARGUMENTS"
        else:
            return "VALID COMMAND"

    # STATS
    if lista_comando[0] == "STATS":
        if len(lista_comando) < 2:
            return "MISSING ARGUMENTS"

        if lista_comando[1] == "K":
            if len(lista_comando) < 3:
                return "MISSING ARGUMENTS"
            elif len(lista_comando) > 3:
                return "TOO MANY ARGUMENTS"
            else:
                return "VALID COMMAND"
        if lista_comando[1] == "N" or lista_comando[1] == "D":
            if len(lista_comando) == 2:
                return "VALID COMMAND"
            elif len(lista_comando) > 2:
                return "TOO MANY ARGUMENTS"

    # PRINT
    if lista_comando[0] == "PRINT":
        if len(lista_comando) == 1:
            return "VALID COMMAND"
        else:
            return "MISSING ARGUMENTS"

    # SLEEP
    if lista_comando[0] == "SLEEP":
        if len(lista_comando) == 2:
            return "VALID COMMAND"
        else:
            return "MISSING ARGUMENTS"

    # EXIT
    if lista_comando[0] == "EXIT":
        if len(lista_comando) == 1:
            return "VALID COMMAND"
        else:
            return "MISSING ARGUMENTS"

    # QUALQUER OUTRO COMANDO
    else:
        return "UNKNOWN COMMAND"

# Verificação da linha de comandos
if len(sys.argv) < 4:
    print("Parâmetros insuficientes, deve adotar a seguinte convenção: \n python3 ficheiro.py id_cliente ip_servidor porto_tcp" )
elif len(sys.argv) > 4:
    print("Parâmetros a mais, deve adotar a seguinte convenção: \n python3 ficheiro.py id_cliente ip_servidor porto_tcp" )
else:
    ID_CLIENTE = sys.argv[1]
    HOST = sys.argv[2]
    PORT = int(sys.argv[3])

    cliente = net_client.server_connection(HOST, PORT)

    while True:
        comando = input("comando > ")
        
        if valida_comandos(comando) == "VALID COMMAND":
                
            if comando == "EXIT":
                break
            elif comando.split(" ")[0] == "SLEEP":
                time.sleep(int(comando.split(" ")[1])) 
            else:
                comando += " " + str(ID_CLIENTE)
                cliente.connect()
            
                resposta = cliente.send_receive(comando)

                cliente.close()
                print("Recebi a seguinte resposta do servidor: " + resposta)

        else:
            print(valida_comandos(comando))