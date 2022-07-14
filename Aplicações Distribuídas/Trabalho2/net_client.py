# -*- coding: utf-8 -*-
"""
Aplicações Distribuídas - Projeto 1 - net_client.py
Grupo: 14
Números de aluno: 55853, 56935
"""

# zona para fazer importação
import sock_utils, pickle, struct

###############################################################################

# definição da classe server_connection 
class server_connection:
    """
    Abstrai uma ligação a um servidor TCP. Implementa métodos para: estabelecer 
    a ligação; envio de um comando e receção da resposta; terminar a ligação.
    """
    def __init__(self, address, port):
        """
        Inicializa a classe com parâmetros para funcionamento futuro.
        """
        self.address = address
        self.port = port
        self.sock = None 


    def connect(self):
        """
        Estabelece a ligação ao servidor especificado na inicialização.
        """
        self.sock = sock_utils.create_tcp_client_socket(self.address, self.port)


    def send_receive(self, data):
        """
        Envia os dados contidos em data para a socket da ligação, e retorna
        a resposta recebida pela mesma socket.
        """
        # envio da mensagem 
        msg_bytes = pickle.dumps(data, -1) # obtem o objeto serializado
        size_bytes = struct.pack("i", len(msg_bytes)) # calcula o tamanho do objeto serializado
        self.sock.sendall(size_bytes) # envia os tamanho do objeto
        self.sock.sendall(msg_bytes) # envia a lista

        # receção da mensagem
        size_resposta_bytes = self.sock.recv(4) # tamanho de bytes serializado
        size_resposta = struct.unpack('i', size_resposta_bytes)[0] # deserializa esse numero
        resposta_bytes = sock_utils.receive_all(self.sock, size_resposta)
        resposta = pickle.loads(resposta_bytes)

        return resposta

    
    def close(self):
        """
        Termina a ligação ao servidor.
        """
        self.sock.close()