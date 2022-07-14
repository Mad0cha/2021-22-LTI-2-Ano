#!/usr/bin/python
# -*- coding: utf-8 -*-
"""
Aplicações Distribuídas - Projeto 1 - lock_client.py
Grupo: 14
Números de aluno: 55853, 56935
"""

# Zona para fazer imports
import net_client, sys, time
from lock_stub import LockStub

###############################################################################
# Programa principal

def valida_comandos(comando, cliente):

    # ver se o strip nao fica melhor
    lista_comando = comando.strip().split(" ")
    # print(lista_comando)

    # LOCK
    if lista_comando[0] == "LOCK":
        if len(lista_comando) < 4:
            return "MISSING ARGUMENTS"
        elif len(lista_comando) > 4:
            return "TOO MANY ARGUMENTS"
        else:
            return [lista_comando[0], lista_comando[1], lista_comando[2], lista_comando[3], cliente]

    # UNLOCK
    if lista_comando[0] == "UNLOCK":
        if len(lista_comando) < 3:
            return "MISSING ARGUMENTS"
        elif len(lista_comando) > 3:
            return "TOO MANY ARGUMENTS"
        else:
            return [lista_comando[0], lista_comando[1], lista_comando[2], cliente]

    # STATUS
    if lista_comando[0] == "STATUS":
        if len(lista_comando) < 2:
            return "MISSING ARGUMENTS"
        elif len(lista_comando) > 2:
            return "TOO MANY ARGUMENTS"
        else:
            return [lista_comando[0], lista_comando[1]]

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
                return [lista_comando[0], lista_comando[1], lista_comando[2]]

        if lista_comando[1] == "N":
            if len(lista_comando) == 2:
                return [lista_comando[0], lista_comando[1]]
            elif len(lista_comando) > 2:
                return "TOO MANY ARGUMENTS"

        if lista_comando[1] == "D":
            if len(lista_comando) == 2:
                return [lista_comando[0], lista_comando[1]]
            elif len(lista_comando) > 2:
                return "TOO MANY ARGUMENTS"

    # PRINT
    if lista_comando[0] == "PRINT":
        if len(lista_comando) == 1:
            return [lista_comando[0]]
        else:
            return "MISSING ARGUMENTS"

    # SLEEP
    if lista_comando[0] == "SLEEP":
        if len(lista_comando) == 2:
            return [lista_comando[0], lista_comando[1]]
        else:
            return "MISSING ARGUMENTS"

    # EXIT
    if lista_comando[0] == "EXIT":
        if len(lista_comando) == 1:
            return [lista_comando[0]]
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

    ciclo = True

    cliente_stub = LockStub(HOST, PORT)
    cliente_stub.connect()

    while ciclo:
        comando = input("comando > ")

        validacao = valida_comandos(comando, ID_CLIENTE)
        
        if validacao not in ["MISSING ARGUMENTS", "UNKNOWN COMMAND", "TOO MANY ARGUMENTS"]:
        
            if validacao[0] == "EXIT":
                ciclo = False

            elif validacao[0] == "SLEEP":
                time.sleep(int(validacao[1])) 
                
            else:

                if validacao[0] == "LOCK":
                    resposta = cliente_stub.lock(validacao[1:])
                
                elif validacao[0] == "UNLOCK":
                    resposta = cliente_stub.unlock(validacao[1:])

                elif validacao[0] == "STATUS":
                    resposta = cliente_stub.status(validacao[1:])

                elif validacao[0] == "STATS":
                    resposta = cliente_stub.stats(validacao[1:])

                elif validacao[0] == "PRINT":
                    resposta = cliente_stub.print()
                
                print("Recebi a seguinte resposta do servidor: " + str(resposta))

        else:
            print(validacao)

    cliente_stub.disconnect()
    exit()