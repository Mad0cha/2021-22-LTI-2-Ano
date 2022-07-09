package client;

import business.Reputacao;
import business.User;

/**
 * <p>Cliente1 class.</p>
 * 
 * Neste cliente vamos criar 3 utilizadores, em que o utilizador1 cria 1 leilao. Os outros dois licitam.
 * A um certo momento, ou seja, apos algumas licitacoes (validas ou invalidas), um dos leilões vai ser encerrado 
 * (neste caso manualmente, pois as comparacoes sao feitas com tempo real ) e apos isso um dos utilizadores vai avaliar 
 * o utilizador1 e vai tudo proceder bem com o sistema a retornar o vencedor.
 * 
 * @author Grupo12: MadalenaRodrigues_55853, PedroAlmeida_56897, RomuloNogueira_56935
 * @version $Id: $Id
 */

public class Cliente1 {
	
	/**
	 * <p>main.</p>
	 *
	 * @param args an array of {@link java.lang.String} objects
	 */
	public static void main(String[] args) {
		
		User user1 = new User("Jorge Antunes"); 
		
		User user2 = new User("Manuel Freitas"); 
		
		User user3 = new User("Catarina Silveira"); 

		System.out.println("============================================");
		System.out.println("Utilizadores envolvidos");
		System.out.println("============================================");
		System.out.println(user1.toString());
		System.out.println(user2.toString());
		System.out.println(user3.toString());
		
		System.out.println("============================================");
		System.out.println("Criação dos Artigo");
		System.out.println("============================================");
		
		int idArtigo1 = user1.criarArtigo("Cadeira de secretária");
		int idArtigo2 = user1.criarArtigo("Rato da Razer");
		int idArtigo3 = user2.criarArtigo("Livro do José Mourinho");
		System.out.println();
		user1.imprimirMeusArtigos(); 
		
		System.out.println("============================================");
		System.out.println("Criação dos Leilões");
		System.out.println("============================================");
		
		int idLeilao1  = user1.criarLeilao("normal", idArtigo2);
		int idLeilao2  = user2.criarLeilao("invertido", idArtigo3);
		System.out.println();
		
		user1.imprimirMeusLeiloes();
		
		System.out.println("============================================");
		System.out.println("Configuração de um dos Leilões");
		System.out.println("============================================");
		
		// Vamos também demonstrar que e´ impossivel configurar um leilao que nao foi esse utilizador a criar
		
		user2.configurarLeilao(idLeilao1, "01/07/2022 20:00:00", 20);
		user1.configurarLeilao(idLeilao1, "01/07/2022 20:00:00", 80);
		System.out.println();
		
		user1.imprimirMeusLeiloes();
		
		System.out.println("============================================");
		System.out.println("Tentativa de licitações que são impossiveis de fazer");
		System.out.println("============================================");
		
		System.out.println();
		
		user2.licitarLeilao(idLeilao1, 50);
		user1.licitarLeilao(idLeilao1, 40);
		
		System.out.println();
		
		System.out.println("============================================");
		System.out.println("Publicar leilão");
		System.out.println("============================================");
		
		// Primeiro vamos tentar publicar um leilao nao configurado, pelo que nao vai ser publicado e
		// De seguida vamos publicar um leilao ja configurado.
		// Vamos tambem demonstrar que e´ impossivel publicar um leilao que nao e criado por esse user
		
		user2.publicaLeilao(10);
		user2.publicaLeilao(idLeilao1);
		System.out.println();
		
		user1.publicaLeilao(idLeilao1);
		System.out.println();
		user1.imprimirMeusLeiloes();
	
		System.out.println("============================================");
		System.out.println("Licitar em leilão");
		System.out.println("============================================");
		
		// Vamos tentar licitar no leilao com o proprio utilizador
		// Vamos tentar licitar um preço menor que o minimo e um menor que o atual
		// Por fim vamos fazer algumas licitacoes  e mostrar as mudanças do estado do leilao
		
		System.out.println();
		user1.licitarLeilao(idLeilao1, 90);
		user2.licitarLeilao(idLeilao1, 60);
		
		System.out.println();
		user2.licitarLeilao(idLeilao1, 100);
		System.out.println();
		System.out.println(user1.obtemLeilao(idLeilao1).toString());
		
		System.out.println();
		user3.licitarLeilao(idLeilao1, 90);
		
		System.out.println();
		user3.licitarLeilao(idLeilao1, 150);
		System.out.println();
		System.out.println(user1.obtemLeilao(idLeilao1).toString());
		
		System.out.println("============================================");
		System.out.println("Encerrar leilão");
		System.out.println("============================================");

		// Uma vez que estamos num script e tudo corre ao mesmo tempo, vamos ter de encerrar o leilao "`a mao" 
		// para visualizar o encerramento do mesmo.

		user3.encerraLeilao(idLeilao1);
		user1.encerraLeilao(5);
		System.out.println();
		
		user1.encerraLeilao(idLeilao1);
		
		System.out.println();
		
		user1.imprimirMeusLeiloes();
		user1.imprimirMeusArtigos();
		
		System.out.println("============================================");
		System.out.println("Preencher reputações");
		System.out.println("============================================");
		
		User vendedor = user1;
		User comprador = vendedor.obtemLeilao(idLeilao1).getVencedor();
		Reputacao rep_vendedor = comprador.formularioReputacao(idLeilao1, Reputacao.EXCELENTE);
		Reputacao rep_comprador = vendedor.formularioReputacao(idLeilao1, Reputacao.SUFICIENTE);
		System.out.println("Reputacao atribuida ao vendedor: " + rep_vendedor + ", ao comprador: " + rep_comprador);
		
		comprador.adicionaReputacao(rep_comprador);
		vendedor.adicionaReputacao(rep_vendedor);
		
		System.out.println("Reputação atual do vendedor: " + vendedor.obtemReputacao());
		System.out.println("Reputação atual do comprador: " + comprador.obtemReputacao());
		System.out.println();
		user1.arquivaLeilao(idLeilao1);
		System.out.println();
		user1.imprimirMeusLeiloes();	
	}
	
}