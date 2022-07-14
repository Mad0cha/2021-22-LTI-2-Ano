# Zona para fazer importação
# import sys
# import sock_utils
import time
# import struct
# import pickle
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
        segundos. Retorna True ou False. O bloqueio pode ser de escrita (type=W)
        ou de leitura (type=R).
        """
        # Código: 10
        # Para escrita
        if type == "W":

            if self.estado_recurso == "UNLOCKED":

                self.estado_recurso = "LOCKED-W"
                self.n_vezes += 1
                self.cliente_block = (client_id, time.time() + int(time_limit))
                return [11, True]

            else:
                return [11, False]
        
        # Para leitura
        elif type == "R": 

            if self.estado_recurso == "LOCKED-R" or self.estado_recurso == "UNLOCKED":

                self.estado_recurso = "LOCKED-R" 
                self.clientes_blocks.append((client_id, time.time() + int(time_limit))) 
                return [11, True]

            else:
                return [11,False]

    
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
        Retorna True ou False.O desbloqueio pode ser relacionado a bloqueios 
        de escrita (type=W) ou de leitura (type=R), consoante o tipo.
        """
        # Código: 20
        # Para escrita
        if type == "W":
            if self.estado_recurso == "LOCKED-W" and self.cliente_block[0] == client_id:

                self.estado_recurso = "UNLOCKED"
                self.cliente_block = ()
                return [21, True]

            else:  
                return [21, False]

        # Para outro
        else:
            if self.estado_recurso == "LOCKED-R" and client_id in list(map(lambda t: t[0], self.clientes_blocks)):

                self.clientes_blocks = list(filter(lambda t: t[0] != client_id, self.clientes_blocks))
                if len(self.clientes_blocks) == 0:
                    self.estado_recurso = "UNLOCKED"
                return [21, True]

            else: 
                return [21, False]


    def status(self):
        """
        Obtém o estado do recurso. Retorna LOCKED-W ou LOCKED-R ou UNLOCKED 
        ou DISABLED.
        """
        # Código: 30
        return [31, self.estado_recurso]

    
    def stats(self):
        """
        Retorna o número de bloqueios de escrita feitos neste recurso. 
        """
        # Código: 40/50/60
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
        # Código: 70
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
        self.array_locks = [resource_lock(i+1) for i in range(N)] # [recurso1, recurso2, ...]
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
            if recurso.status()[1] in ["LOCKED-W", "LOCKED-R"]: 
                recurso.release()
            
            if recurso.status()[1] == "UNLOCKED":
                if recurso.stats() == self.maxBlocks:
                    recurso.disable()


    def lock(self, tipo, resource_id, client_id, time_limit):
        """
        Tenta bloquear (do tipo R ou W) o recurso resource_id pelo cliente client_id, 
        durante time_limit segundos. Retorna True, False ou None.
        """
        # Código: 10
        if 0 < int(resource_id) <= self.quant_recursos:
            return self.array_locks[int(resource_id) - 1].lock(tipo, client_id, time_limit)

        else:
            return [11, None]


    def unlock(self, tipo, resource_id, client_id):
        """
        Liberta o bloqueio (do tipo R ou W) sobre o recurso resource_id pelo cliente 
        client_id. Retorna True, False ou None.
        """
        # Código: 20
        if 0 < int(resource_id) <= self.quant_recursos: 
            return self.array_locks[int(resource_id) - 1].unlock(tipo, client_id)  
        
        else:
            return [21,None]


    def status(self, resource_id):
        """
        Obtém o estado de um recurso. Retorna LOCKED, UNLOCKED,
        DISABLED ou None.
        """
        # Código: 30
        if 0 < int(resource_id) <= self.quant_recursos: 
            return self.array_locks[int(resource_id) - 1].status()
        else:
            return [31,None]


    def stats(self, option, resource_id = 0): 
        """
        Obtém o estado do serviço de gestão de bloqueios. Se option for K, retorna <número de 
        bloqueios feitos no recurso resource_id> ou None. Se option for N, retorna 
        <número de recursos desbloqueados atualmente>. Se option for D, retorna 
        <número de recursos desabilitados>
        """
        # Para o K
        # Código: 40
        if option == 40:

            if 0 < int(resource_id) <= self.quant_recursos:
                return [41, self.array_locks[int(resource_id) - 1].stats()]
            else:
                return [41, None]
        
        # Para o N
        # Código: 50
        elif option == 50:

            contador = 0
            for recurso in self.array_locks:
                if recurso.status()[1] == "UNLOCKED":  
                    contador +=1
            return [51, contador]
        
        # Para outro
        # Código: 60
        else:
            contador = 0
            for recurso in self.array_locks:
                if recurso.status()[1] == "DISABLED":  
                    contador +=1
            return [61,contador]


    def __repr__(self):
        """
        Representação da classe para a saída standard. A string devolvida por
        esta função é usada, por exemplo, se uma instância da classe for
        passada à função print ou str.
        """
        # Código: 70
        output = ""
  
        for recurso in self.array_locks:

            output += recurso.__repr__() + " "
                
        return [71, output]