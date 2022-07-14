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

###############################################################################

class resource_lock:
    def __init__(self, resource_id):
        """
        Define e inicializa as propriedades do recurso para os bloqueios.
        """
        self.estado_recurso = "UNLOCKED"  
        self.n_vezes = 0
        self.cliente_block = () # para escrita , tuplo (cliente, tempo)
        self.clientes_blocks = [] # para leitura, lista de tuplos [(cliente1, tempo1) , (cliente2, tempo2)...]
        self.resource_id = int(resource_id) 


    def lock(self, type, client_id, time_limit):
        """
        Tenta bloquear o recurso pelo cliente client_id, durante time_limit 
        segundos. Retorna OK ou NOK. O bloqueio pode ser de escrita (type=W)
        ou de leitura (type=R).
        """
        # Para escrita
        if type == "W":

            if self.estado_recurso == "UNLOCKED":

                self.estado_recurso = "LOCKED-W"
                self.n_vezes += 1
                self.cliente_block = (client_id, time.time() + int(time_limit))
                return "OK"

            else:
                return "NOK"
        
        # Para leitura
        elif type == "R": 

            if self.estado_recurso == "LOCKED-R" or self.estado_recurso == "UNLOCKED":

                self.estado_recurso = "LOCKED-R" 
                self.clientes_blocks.append((client_id, time.time() + int(time_limit))) 
                return "OK"

            else:
                return "NOK"

    
    def release(self):
        """
        Liberta o recurso incondicionalmente, alterando os valores associados
        ao bloqueio.
        """
        if len(self.cliente_block) != 0:
          
            if time.time() > self.cliente_block[1]:
                self.cliente_block = ()
                self.estado_recurso = "UNLOCKED"

        else:
            if len(self.clientes_blocks) != 0:

                novaLista = []
                for t in self.clientes_blocks:
                    if time.time() < t[1]:
                        novaLista.append(t)

                self.clientes_blocks = novaLista

                if len(self.clientes_blocks) == 0:
                    self.estado_recurso = "UNLOCKED"                        

        
    def unlock(self, type, client_id):
        """
        Liberta o recurso se este está bloqueado pelo cliente client_id.
        Retorna OK ou NOK.O desbloqueio pode ser relacionado a bloqueios 
        de escrita (type=W) ou de leitura (type=R), consoante o tipo.
        """
        
        # Para escrita
        if type == "W":
            if self.estado_recurso == "LOCKED-W" and self.cliente_block[0] == client_id:

                self.estado_recurso = "UNLOCKED"
                self.cliente_block = ()
                return "OK"

            else:  
                return "NOK"

        # Para outro
        else:
            if self.estado_recurso == "LOCKED-R" and client_id in list(map(lambda t: t[0], self.clientes_blocks)):

                self.clientes_blocks = list(filter(lambda t: t[0] != client_id, self.clientes_blocks))
                if len(self.clientes_blocks) == 0:
                    self.estado_recurso = "UNLOCKED"
                return "OK"

            else: 
                return "NOK"


    def status(self):
        """
        Obtém o estado do recurso. Retorna LOCKED-W ou LOCKED-R ou UNLOCKED 
        ou DISABLED.
        """
        return self.estado_recurso

    
    def stats(self):
        """
        Retorna o número de bloqueios de escrita feitos neste recurso. 
        """
        return self.n_vezes
   

    def disable(self):
        """
        Coloca o recurso como desabilitado incondicionalmente, alterando os 
        valores associados à sua disponibilidade.
        """
        self.estado_recurso = "DISABLED"
        self.clientes_blocks = []
        self.cliente_block = ()


    def __repr__(self):
        """
        Representação da classe para a saída standard. A string devolvida por
        esta função é usada, por exemplo, se uma instância da classe for
        passada à função print ou str.
        """
        output = ""

        # Se o recurso está bloqueado para a escrita:
        # R <num do recurso> LOCKED-W <vezes bloqueios de escrita> <id do cliente> <deadline do bloqueio de escrita>
        if self.estado_recurso == "LOCKED-W":
            output = "R" + str(self.resource_id) + " LOCKED-W " + str(self.n_vezes) + " " + str(self.cliente_block[0]) + " " + str(self.cliente_block[1])
      
        # Se o recurso está bloqueado para a leitura:
        # R <num do recurso> LOCKED-R <vezes bloqueios de escrita> <num bloqueios de leitura atuais> <último deadline dos bloqueios de leitura>
        elif self.estado_recurso == "LOCKED-R":
            output = "R" + str(self.resource_id) + " LOCKED-R " + str(self.n_vezes) + " " + str(len(self.clientes_blocks)) + " " + str(self.clientes_blocks[-1][1])
       
        # Se o recurso está desbloqueado:
        # R <num do recurso> UNLOCKED
        elif self.estado_recurso == "UNLOCKED":
            output = "R" + str(self.resource_id) + " UNLOCKED"
       
        # Se o recurso está inativo:
        # R <num do recurso> DISABLED
        else:
            output = "R" + str(self.resource_id) + " DISABLED"
        
        return output

###############################################################################

class lock_pool:

    def __init__(self, N, K):
        """
        Define um array com um conjunto de resource_locks para N recursos. 
        Os locks podem ser manipulados pelos métodos desta classe. 
        Define K, o número máximo de bloqueios de escrita permitidos para cada 
        recurso. Ao atingir K bloqueios de escrita, o recurso fica desabilitado.
        """
        self.array_locks = [resource_lock(i) for i in range(N)] # [recurso1, recurso2, ...]
        self.quant_recursos = int(N)
        self.maxBlocks = int(K)
        
    
    def clear_expired_locks(self):
        """
        Verifica se os recursos que estão bloqueados ainda estão dentro do tempo
        de concessão dos bloqueios. Remove os bloqueios para os quais o tempo de
        concessão tenha expirado.
        """
        # Cada recurso existente
        for recurso in self.array_locks: 
            if recurso.status() in ["LOCKED-W", "LOCKED-R"]: 
                recurso.release()
            
            if recurso.status() == "UNLOCKED":
                if recurso.stats() == pool.maxBlocks:
                    recurso.disable()


    def lock(self, type, resource_id, client_id, time_limit):
        """
        Tenta bloquear (do tipo R ou W) o recurso resource_id pelo cliente client_id, 
        durante time_limit segundos. Retorna OK, NOK ou UNKNOWN RESOURCE.
        """
        if 0 <= int(resource_id) < self.quant_recursos:
            return self.array_locks[int(resource_id)].lock(type, client_id, time_limit)

        else:
            return "UNKOWN RESOURCE"


    def unlock(self, type, resource_id, client_id):
        """
        Liberta o bloqueio (do tipo R ou W) sobre o recurso resource_id pelo cliente 
        client_id. Retorna OK, NOK ou UNKNOWN RESOURCE.
        """
        if 0 <= int(resource_id) <= self.quant_recursos: 
            return self.array_locks[int(resource_id)].unlock(type, client_id)  
        
        else:
            return "UNKNOWN RESOURCE"


    def status(self, resource_id):
        """
        Obtém o estado de um recurso. Retorna LOCKED, UNLOCKED,
        DISABLED ou UNKNOWN RESOURCE.
        """
        if 0 <= int(resource_id) < self.quant_recursos: 
            return self.array_locks[int(resource_id)].status()
        else:
            return "UNKNOWN RESOURCE"


    def stats(self, option, resource_id = 0): 
        """
        Obtém o estado do serviço de gestão de bloqueios. Se option for K, retorna <número de 
        bloqueios feitos no recurso resource_id> ou UNKNOWN RESOURCE. Se option for N, retorna 
        <número de recursos desbloqueados atualmente>. Se option for D, retorna 
        <número de recursos desabilitados>
        """
        # Para o K
        if option == "K":

            if 0 <= int(resource_id) < self.quant_recursos:
                return str(self.array_locks[int(resource_id)].stats())
            else:
                return "UNKNOWN RESOURCE" 
        
        # Para o N
        elif option == "N":

            contador = 0
            for recurso in self.array_locks:
                if recurso.status() == "UNLOCKED":  
                    contador +=1
            return str(contador)
        
        # Para outro
        else:
            contador = 0
            for recurso in self.array_locks:
                if recurso.status() == "DISABLED":  
                    contador +=1
            return str(contador)


    def __repr__(self):
        """
        Representação da classe para a saída standard. A string devolvida por
        esta função é usada, por exemplo, se uma instância da classe for
        passada à função print ou str.
        """
        output = ""
  
        for recurso in self.array_locks:

            output += recurso.__repr__() + " "
                
        return output

###############################################################################
# código do programa principal

if len(sys.argv) == 5:

    HOST = sys.argv[1]
    PORT = int(sys.argv[2])
    N_RECURSOS = int(sys.argv[3])
    MAX_RECURSOS = int(sys.argv[4])

    sock = sock_utils.create_tcp_server_socket(HOST, PORT, 1)
    pool = lock_pool(N_RECURSOS, MAX_RECURSOS)

    while True:
        try:
            (conn_sock, (addr, port)) = sock.accept()
            print('ligado a %s no porto %s' % (addr,port))

            msg = conn_sock.recv(1024).decode('utf-8')
            
            # Verifica se já expirou 
            pool.clear_expired_locks()
            
            comando = msg.split(" ")
            resposta = ""

            # LOCK
            if comando[0] in ["LOCK-W", "LOCK-R"]:

                comando = comando[0].split("-") + comando[1:]
                resposta = pool.lock(comando[1], comando[2], comando[4], comando[3])
            
            # UNLOCK
            elif comando[0] in ["UNLOCK-W", "UNLOCK-R"]:

                comando = comando[0].split("-") + comando[1:]
                resposta = pool.unlock(comando[1], comando[2], comando[3])
                
            # STATUS
            elif comando[0] == "STATUS":

                resposta = pool.status(comando[1])
            
            # STATS
            elif comando[0] == "STATS":

                if comando[1] == "K":
                    resposta = pool.stats(comando[1],comando[2])
                else:
                    resposta = pool.stats(comando[1])
            
            # PRINT
            elif comando[0] == "PRINT":

                resposta = pool.__repr__()

            conn_sock.sendall(bytes(resposta, encoding='utf-8'))
        
        except KeyboardInterrupt:
            print("Vou fechar")
            break

        except:
            sock.close()

else:
    print("Argumentos insuficientes ou a mais")