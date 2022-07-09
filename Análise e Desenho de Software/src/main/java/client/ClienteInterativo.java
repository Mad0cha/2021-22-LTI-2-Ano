package client;

/**
 * <p>ClienteInterativo class.</p>
 *
 * @author Grupo12: MadalenaRodrigues_55853, PedroAlmeida_56897, RomuloNogueira_56935
 * @date Maio 2022
 * @version $Id: $Id
 */

import java.util.InputMismatchException;
import java.util.Scanner;

import business.Artigo;
import business.Reputacao;
import business.User;

/**
 * Classe que demonstra o funcionamento do sistema de 
 * gestao de leiloes de forma interativa atraves da
 * consola do utilizador
 */
public class ClienteInterativo {
	
	/**
	 * <p>lerInteiro.</p>
	 *
	 * @param ler 	 valor introduzido pelo utilizador
	 * @param prompt mensagem a aparecer no terminal
	 * @param min    numero minimo a ser apresentado
	 * @param max    numero maximo a ser apresentado
	 * @return       valor introduzido no terminal apos validado
	 */
	public static int lerInteiro(Scanner ler, String prompt, int min, int max) {
		
		while(true) {
			System.out.print(prompt + " (" + min + "-" + max + ")? ");
			try {
				int v = ler.nextInt();
				if(v >= min && v <= max)
					return v;
				System.out.println("Valor tem que ser entre " + min + " e " + max);
			}
			catch(InputMismatchException ex) {
				System.out.println("Tem que ser inteiro");
				ler.nextLine();
			}
		}
	}
	
	
	/**
	 * <p>main.</p>
	 *
	 * @param args an array of {@link java.lang.String} objects
	 */
	public static void main(String[] args) {
		
		Scanner ler = new Scanner(System.in);
		
		System.out.print("Quantos utilizadores criar? ");
		int n = ler.nextInt();
		
		while (n < 2) {
			System.out.println("Têm que existir pelo menos 2 utilizadores");
			System.out.print("Quantos utilizadores criar? ");
			n = ler.nextInt();
		}	

		User users[] = new User[n];
		for(int i = 0; i < n; i++) {
			int u = i + 1;
			System.out.print("Qual o nome do utilizador " + u + "? ");
			String nome = ler.next();
			users[i] = new User(nome);
		}
//		int contArtigos = 0;
//		int indisponiveis = 0;
		while(true) {
			int vendedor_i = lerInteiro(ler, "Qual o vendedor", 1, n);
			User vendedor = users[vendedor_i-1];
	
			String tipo_leilao;
			while(true) {
				System.out.print("Qual o tipo de leilao (cego/invertido/normal)? ");
				tipo_leilao = ler.next();
				if(tipo_leilao.equals("cego") || tipo_leilao.equals("invertido") || tipo_leilao.equals("normal"))
					break;
				else
					System.out.println("Tipo de leilao invalido");
			}
			
	//		vendedor.criaArtigo("Abajour dos anos 50");
	//		vendedor.imprimirMeusArtigos();
	
	//		System.out.print("Criar artigo? (0 ou 1)? ");
	//		if(ler.nextInt() == 1)
	//			System.out.print("Insira a descrição do artigo: ");
	//			String descricao = ler.next();
	//			vendedor.criaArtigo(descricao);
	//		vendedor.imprimirMeusArtigos();	
	//		System.out.print("Qual o artigo? ");
	//		int artigo = ler.nextInt();
	//		int id_leilao = vendedor.criarLeilao(tipo_leilao, artigo);
			
			if(lerInteiro(ler, "Criar artigo", 0, 1) == 1) {
				System.out.print("Insira a descrição do artigo: ");
				String descricao = ler.next();
				vendedor.criarArtigo(descricao);
//				contArtigos++;
	//			System.out.print("Insira a descrição do artigo: ");
	//			String descricao2 = ler.next();
	//			vendedor.criaArtigo(descricao2);
	//			String str=vendedor.obtemArtigos();
				
	//			for(String subString: str.split(",")){
	//			   contArtigos++;
	//			}
			} else {
				vendedor.imprimirMeusArtigos();	
				
			}
	//		System.out.println("lista de artigos: " + vendedor.obtemArtigos());
	//		System.out.println("numero de artigos: " + contArtigos);
	//		int var = 0;
	//		while (contArtigos == 0 | var == 1) {
			
//			for (Artigo art : vendedor.obtemArtigos()) {
//			    if(art.getIdArtigo() == -1) {
//			    	indisponiveis ++;
//			    }
//			    	
//			}
			
			int contArtigos = 0;
			for (int i = 0; i < vendedor.obtemArtigos().size(); i++) {
				contArtigos++;
			}
			
//			while (contArtigos == 0 || indisponiveis==vendedor.obtemArtigos().size()) {
			while (contArtigos == 0) {
				System.out.println("Não tem artigos disponíveis");
				if(lerInteiro(ler, "Criar artigo", 0, 1) == 1) {
					System.out.print("Insira a descrição do artigo: ");
					String descricao = ler.next();
					vendedor.criarArtigo(descricao);
//					contArtigos++;
	//				System.out.print("Criar mais artigos? (0 ou 1)? ");
	//				var = ler.nextInt();
	//				continue;
					contArtigos++;
				} else {
					continue;	
				}
				
			}
			
			
			int var = 1;
			while (var == 1) {
				var = lerInteiro(ler, "Criar mais artigos", 0, 1);
				System.out.println("\n");
				if(var == 1) { 
					System.out.print("Insira a descrição do artigo: ");
					String descricao = ler.next();
					vendedor.criarArtigo(descricao);
					contArtigos++;
				}else {
					break;
				}
			}	
			
//			System.out.print("contArtigos: " + contArtigos);
			
			System.out.print("Os seus artigos: ");
			vendedor.imprimirMeusArtigos();	
			System.out.print("Qual o artigo a leiloar? ");
			int artigo = ler.nextInt();
//			while (artigo >= contArtigos) {
//				System.out.print("O artigo não existe ");
//				System.out.println("\n");
//				System.out.print("Qual o artigo a leiloar? ");
//				artigo = ler.nextInt();
//			}	
			while (artigo < 0 || artigo >= contArtigos) {
//				System.out.print("contArtigos: " + contArtigos);
				System.out.print("O artigo não existe ");
				System.out.println("\n");
				System.out.print("Qual o artigo a leiloar? ");
				artigo = ler.nextInt();
			}	
			int id_leilao = vendedor.criarLeilao(tipo_leilao, artigo);

			System.out.print("Data fecho (dd/MM/yyyy)? ");
			String data_fecho = ler.next();
			System.out.print("Hora fecho (hh:mm:ss)? ");
			String hora_fecho = ler.next();
			String data = data_fecho + " " + hora_fecho;
	//		System.out.print(data);
	//      String data_fecho = ler.nextLine();
			System.out.print("Preco base? ");
			int preco_base = ler.nextInt();
			vendedor.configurarLeilao(id_leilao, data, preco_base);
			vendedor.publicaLeilao(id_leilao);
			
			while(true) {
				int licitador_i = lerInteiro(ler, "Quem licita", 1, n);
				if(licitador_i-1 < 0 || licitador_i >= n+1) {
					System.out.println("Utilizador nao existe");
					continue;
				}
				
				System.out.print("Quanto quer licitar? ");
				int preco = ler.nextInt();
				
				users[licitador_i-1].licitarLeilao(id_leilao, preco);
				
				if(lerInteiro(ler, "Continuar a licitar", 0, 1) == 0)
					break;
			}
			
			vendedor.encerraLeilao(id_leilao);
			
			User comprador = vendedor.obtemLeilao(id_leilao).getVencedor();
			if(comprador != null) {
				// pedir e dar reputacao, caso haja um vencedor
				System.out.println("Vencedor do leilao: " + comprador.obtemNome());
				
				System.out.println("Comprador, o que achou do vendedor?");
				Reputacao rep_vendedor = comprador.formularioReputacaoInterativo(ler, id_leilao);
		
				System.out.println("Vendedor, o que achou do comprador?");
				Reputacao rep_comprador = vendedor.formularioReputacaoInterativo(ler, id_leilao);
				
				comprador.adicionaReputacao(rep_comprador);
				vendedor.adicionaReputacao(rep_vendedor);
				
				System.out.println("Reputação atual do comprador: " + comprador.obtemReputacao());
				System.out.println("Reputação atual do vendedor: " + vendedor.obtemReputacao());
			}
			
			
			if(lerInteiro(ler, "Começar novo leilão", 0, 1) == 0)
				break;
		}
	}
}