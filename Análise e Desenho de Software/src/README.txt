Aplicação Interativa - Instruções de Utilização
-----------------------------------------------

Corre através do ficheiro ClienteInterativo.java, que se encontra no pacote client


Nota: Nas perguntas em que sejam apresentadas as opções (0-1),
 
	 0 corresponde a uma resposta negativa e 1 a uma resposta positiva


Passos:
------

1º -> Nº de utilizadores a criar (Nº inteiro > 0)


2º -> Nome para cada utilizador criado


3º -> Escolher o vendedor -> Nº inteiro > 0 correspondente ao utilizador pretendido


4º -> Escolher o tipo de leilão -> String com o tipo de leilão a criar (cego/invertido/normal)


5º -> Criar artigo (obrigatório caso o utilizador vendedor não tenha nenhum no seu catálogo de artigos)

	5.1 -> Ao criar um artigo deve inserir a descrição do artigo

6º -> Escolher o artigo a leiloar (Nº inteiro correspondente ao Id do artigo)


7º -> Inserir a data de fecho do leilão no formato dd/MM/yyyy (A data deve ser posterior à data atual, caso 
      
      contrário o leilão será dado como terminado ao executar a primeira licitação


8º -> Inserir a hora de fecho do leilão no formato hh:mm:ss 
      

Nota: O conjunto entre a data e hora deve ser posterior à data atual, caso contrário o leilão será 
      dado  como terminado ao executar a primeira licitação


10º -> Inserir o preço base do leilão (Nº inteiro > 0)


9º -> Inserir o número do utilizador a licitar 


10º -> Inserir o valor a licitar


-Os passos 10 e 11 podem ser realizados o número de vezes pretendidas, para continuar a licitar deve ser inserido
 
o valor 1 na resposta à pergunta "Continuar a licitar (0-1)?"


-Para terminar as licitações e consequentemente o leilão, deve ser inserido o valor 0 na resposta à pergunta 

"Continuar a licitar (0-1)?"


-Caso exista um vencedor no leilão, serão atribuídas as reputações de 1 a 4 (pior a melhor)

	-O comprador vencedor irá atribuir uma reputação  ao vendedor

	-O vendedor irá atribuir uma reputação  ao comprador vencedor


12º -> Responder à pergunta "Começar novo leilão (0-1)?" para indicar se pretende ou não começar um novo leilão
	
	-Caso seja iniciado um novo leilão, será escolhido o vendedor de entre os utilizadores anteriormente criados

