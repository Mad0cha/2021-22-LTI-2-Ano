package client;

import business.Reputacao;
import business.User;

/**
 * <p>Cliente2 class.</p>
 *
 *  Neste cliente vao ser criados 5 utilizadores, em que inicialmente apenas 1 tem ma reputacao
 *	O cenario vai ser o seguinte: um utilizador vai ter dois leiloes a decorrer, a uma dada altura ele 
 *  vai encerrar um dos leiloes e vai ser avaliado com uma ma reputação.
 *  
 * @author Grupo12: MadalenaRodrigues_55853, PedroAlmeida_56897, RomuloNogueira_56935
 * @version $Id: $Id
 */
public class Cliente2 {

	/**
	 * <p>main.</p>
	 *
	 * @param args an array of {@link java.lang.String} objects
	 */
	public static void main(String[] args) {
		
		User user1 = new User("Jorge Antunes"); 
		User user2 = new User("Manuel Freitas"); 
		User user3 = new User("Catarina Silveira"); 
		User user4 = new User("João Malvado"); 
		User user5 = new User("Sónia Félix"); 
		
		user1.adicionaReputacao(Reputacao.BOA);
		user2.adicionaReputacao(Reputacao.EXCELENTE);
		user3.adicionaReputacao(Reputacao.MA);
		user5.adicionaReputacao(Reputacao.SUFICIENTE);

		System.out.println("============================================");
		System.out.println("Utilizadores envolvidos");
		System.out.println("============================================");
		System.out.println(user1.toString());
		System.out.println(user2.toString());
		System.out.println(user3.toString());
		System.out.println(user4.toString());
		System.out.println(user5.toString());
		
		
		System.out.println("============================================");
		System.out.println("Criação e configuração e publicação dos leilões do user4");
		System.out.println("============================================");
		System.out.println();
		int idArtigo1 = user4.criarArtigo("FIFA 22 - PS5");
		int idArtigo2 = user4.criarArtigo("Playstation 4");
		int idArtigo3 = user4.criarArtigo("Volante Logitech g29");
		
		int idLeilao1 = user4.criarLeilao("normal", idArtigo2);
		int idLeilao2 = user4.criarLeilao("normal", idArtigo3);
		
		
		user4.configurarLeilao(idLeilao1, "22/07/2022 21:23:00", 25);
		user4.configurarLeilao(idLeilao2, "22/07/2022 21:23:00", 150);
			
		
		user4.publicaLeilao(idLeilao1);
		user4.publicaLeilao(idLeilao2);
		
		System.out.println();
		System.out.println("============================================");
		System.out.println("Licitações antes do encerramento do leilao 1");
		System.out.println("============================================");
		System.out.println();
		user2.licitarLeilao(idLeilao1, 30);
		user1.licitarLeilao(idLeilao2, 155);
		
		System.out.println();
		System.out.println("============================================");
		System.out.println("Encerramento do leilao 1 e reputações");
		System.out.println("============================================");
		System.out.println();
		user4.encerraLeilao(idLeilao1);
		System.out.println();
		
		User vendedor = user4;
		User comprador = vendedor.obtemLeilao(idLeilao1).getVencedor();
		Reputacao rep_vendedor = comprador.formularioReputacao(idLeilao1, Reputacao.MA);
		Reputacao rep_comprador = vendedor.formularioReputacao(idLeilao1, Reputacao.SUFICIENTE);
		System.out.println("Reputacao atribuida ao vendedor: " + rep_vendedor + ", ao comprador: " + rep_comprador);
		
		comprador.adicionaReputacao(rep_comprador);
		vendedor.adicionaReputacao(rep_vendedor);
		
		System.out.println("Reputação atual do vendedor: " + vendedor.obtemReputacao());
		System.out.println("Reputação atual do comprador: " + comprador.obtemReputacao());
		System.out.println();
		
		System.out.println("============================================");
		System.out.println("Licitações após a má reputação do user4");
		System.out.println("============================================");

		user1.licitarLeilao(idLeilao2, 160);
		user4.imprimirMeusLeiloes();
		
		user3.licitarLeilao(idLeilao2, 180);
		
	}

}