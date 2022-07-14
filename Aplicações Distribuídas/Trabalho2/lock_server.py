#!/usr/bin/python
# -*- coding: utf-8 -*-
"""
Aplicações Distribuídas - Projeto 1 - lock_server.py
Grupo: 14
Números de aluno: 55853, 56935
"""

# Zona para fazer importação
import sys
import sock_utils
import time
import struct
import pickle
from lock_skel import LockSkeleton
import select as sel
###############################################################################
# código do programa principal

if len(sys.argv) == 5:

    HOST = sys.argv[1]
    PORT = int(sys.argv[2])
    N_RECURSOS = int(sys.argv[3])
    MAX_RECURSOS = int(sys.argv[4])


    listen_socket = sock_utils.create_tcp_server_socket(HOST, PORT, 1)
    servidor_skel = LockSkeleton(N_RECURSOS, MAX_RECURSOS)
    socket_list = [listen_socket, sys.stdin]

    while True:
        try:
            R, W, X = sel.select(socket_list, [], []) # Espera sockets
            for sckt in R: # Para socket que vem em R
                if sckt is listen_socket:
                    conn_sock, addr = listen_socket.accept()
                    addr, port = conn_sock.getpeername()
                    print('Novo cliente ligado desde %s:%d' % (addr, port))
                    socket_list.append(conn_sock)

                elif sckt is sys.stdin:
                    msg = sckt.readline().strip()
                    if msg == "EXIT":
                        print("VOU ENCERRAR")
                        sys.exit(0)

                else:
                    size_bytes = sckt.recv(4) # tamanho de bytes serializado
                    size = struct.unpack('i', size_bytes)[0] # deserializa esse numero
                    
                    msg_bytes = sock_utils.receive_all(sckt, size)

                    if msg_bytes: 

                        servidor_skel.clear_expired_locks()

                        resp_bytes = servidor_skel.processMessage(msg_bytes)

                        size_resp_bytes = struct.pack("i", len(resp_bytes)) # calcula o tamanho do objeto serializado
                        sckt.sendall(size_resp_bytes) # envia os tamanho do objeto
                        sckt.sendall(resp_bytes) # envia a lista
      

        except (KeyboardInterrupt, SystemExit):

            for sckt in socket_list:
                sckt.close()
                socket_list.remove(sckt)

            break
        except struct.error: # cliente fechou ligação
                sckt.close() 
                socket_list.remove(sckt)
                print('Cliente fechou ligação')

        except:
            print(sys.exc_info())

    listen_socket.close()

else:
    print("Argumentos insuficientes ou a mais")
