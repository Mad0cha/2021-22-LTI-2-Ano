import pickle
from lock_pool import lock_pool

class LockSkeleton:
    def __init__(self, N_RECURSOS, MAX_RECURSOS):
        self.pool = lock_pool(N_RECURSOS, MAX_RECURSOS)
        
    def processMessage(self, msg_bytes) :
        pedido = self.bytesToList(msg_bytes)
        resposta = []
            
        # LOCK
        if pedido[0] == 10:

            resposta = self.pool.lock(pedido[1], pedido[2], pedido[4], pedido[3])
        
        # UNLOCK
        elif pedido[0] == 20:

            resposta = self.pool.unlock(pedido[1], pedido[2], pedido[3])
            
        # STATUS
        elif pedido[0] == 30:

            resposta = self.pool.status(pedido[1])
        
        # STATS
        elif pedido[0] in [40,50,60]:

            if pedido[0] == 40:
                resposta = self.pool.stats(pedido[0],pedido[1])
            else:
                resposta = self.pool.stats(pedido[0])
        
        # PRINT
        elif pedido[0] == 70:
            resposta = self.pool.__repr__()

        return self.listToBytes(resposta)


    def bytesToList(self, pedido_bytes):
        return pickle.loads(pedido_bytes)

    def listToBytes(self, resposta):
        return pickle.dumps(resposta)

    def clear_expired_locks(self):
        self.pool.clear_expired_locks()
