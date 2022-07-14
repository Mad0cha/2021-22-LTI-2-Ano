import net_client

class LockStub:
	def __init__(self, host, port):
		self.conn_sock = net_client.server_connection(host, port)


	def connect(self):
		self.conn_sock.connect()


	def disconnect(self):
		self.conn_sock.close()


	def lock(self, pedido):
		
		msg = [10, pedido[0], pedido[1], pedido[2], pedido[3]]
		resposta = self.conn_sock.send_receive(msg)

		return resposta

	def unlock(self, pedido):

		msg = [20, pedido[0], pedido[1], pedido[2]]
		resposta = self.conn_sock.send_receive(msg)

		return resposta

	def status(self, pedido):

		msg = [30, pedido[0]]
		resposta = self.conn_sock.send_receive(msg) 

		return resposta

	def stats(self, pedido):

		msg = []
		if pedido[0] == "K":
			msg = [40, pedido[1]]
		
		elif pedido[0] == "N":
			msg = [50]

		else:
			msg = [60]

		resposta = self.conn_sock.send_receive(msg)

		return resposta

	def print(self):

		msg = [70]
		resposta = self.conn_sock.send_receive(msg)

		return resposta


