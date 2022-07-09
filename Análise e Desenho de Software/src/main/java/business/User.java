package business;

/**
 * <p>User class.</p>
 *
 * @author Grupo12: MadalenaRodrigues_55853, PedroAlmeida_56897, RomuloNogueira_56935
 * @version $Id: $Id
 */

import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.Scanner;
import java.util.Map.Entry;

/**
 * Classe que gere um utilizador (comprador ou vendedor)
 *
 */
public class User {
	
	private static int contadorIds;
	private int idUser;
	private String nome;
	private List<Reputacao> reputacoes;
	private CatalogoDeLeiloes catalogoDeLeiloes;
	private List<Artigo> artigos;
	
	
	/**
	 * Construtor de um utilizador, seja ele comprador ou vendedor
	 *
	 * @param nome Nome do utilizador
	 */
	public User(String nome) {
		
		User.contadorIds++;
		this.idUser = User.contadorIds;
		this.nome = nome;
		this.catalogoDeLeiloes = new CatalogoDeLeiloes();
		this.artigos = new ArrayList<Artigo>();
		this.reputacoes = new ArrayList<Reputacao>();
	}
	
	
	/**
	 * Metodo para obter o id do utilizador
	 *
	 * @return o id do utilizador
	 */
	public int obtemId() { return this.idUser; }
	
	
	/**
	 * Metodo para obter o nome do utilizador
	 *
	 * @return o nome do utilizador
	 */
	public String obtemNome() { return this.nome; }
	
	
	/**
	 * Obtem a reputacao do utilizador, esta e' a media das
	 * reputacoes dadas pelos compradores e pelos vendedores.
	 * Se nao tiver reputacao ainda, esta sera definida como
	 * NAO_TEM.
	 *
	 * @return A reputação do utilizador
	 */
	public Reputacao obtemReputacao() {
		
		if(reputacoes.size() == 0)
			return Reputacao.NAO_TEM;
		double res = 0;
		for(Reputacao rep : reputacoes) {
			res += ((double)rep.getValor()) / reputacoes.size();
		}
		return Reputacao.getReputacao((int)Math.round(res));
	}
	
	
	/**
	 * Metodo para obter o leilao com id: idLeilao do catalogo de leiloes
	 *
	 * @param idLeilao id do leilao que queremos obter
	 * @return o leilão correspondente
	 */
	public Leilao obtemLeilao(int idLeilao) { return this.catalogoDeLeiloes.obtemLeilao(idLeilao); }
	
	
	/**
	 * Metodo que imprime os leiloes do user que estao no catalogo de leiloes
	 */
	public void imprimirMeusLeiloes() {
		
		HashMap<Integer, Leilao> e = catalogoDeLeiloes.obtemLeiloesVendedor(this.idUser);

		if (e.size() == 0) {
			System.out.println("Não tem nenhum leilão criado no catálogo de leilões");
		}else {
			System.out.println("Meus leilões:");
			System.out.println();
			for (Entry<Integer, Leilao> r : e.entrySet()) {
				System.out.println("Id Leilão: " + r.getKey());
				System.out.println(r.getValue().toString());
				System.out.println("\n");
			}
		}
	}
	
	
	/**
	 * Metodo para imprimir os artigos do utilizador
	 */
	public void imprimirMeusArtigos() {
		System.out.println("Meus artigos:");
		System.out.println();
		if (this.artigos.size() == 0) {
			System.out.println("Não tem nenhum artigo no catálogo de artigos");
		}else {
			for (int i = 0; i < this.artigos.size(); i++) {
				if(this.artigos.get(i).obtemUser().obtemId() == this.obtemId()) {
					System.out.println(this.artigos.get(i).toString());
					System.out.println("\n");
				}
			}
		}
	}
	
	
	/**
	 * Metodo para obter todos os leiloes do catalogo de leiloes
	 *
	 * @return Representação textual de todos os leiloes no catalogo de leiloes
	 */
	public String obtemLeiloes() { return this.catalogoDeLeiloes.toString(); }

	
    /**
     * Metodo para obter todos os artigos do utilizador
     *
     * @return Lista de artigos do utilizador
     */
    public List<Artigo> obtemArtigos() {return this.artigos;}
    	
	
	/**
	 * Metodo que valida um utilizador verificando se a
	 * sua reputacao e' boa, ou seja, diferente de MA
	 *
	 * @return True se for diferente de MA, False caso contrario
	 */
	public boolean validaVendedor() { return obtemReputacao() != Reputacao.MA; }
	
	
	/**
	 * Adiciona o artigo `a lista de artigos do utilizador
	 *
	 * @param descricao Descricao do artigo
	 * @return o id do artigo
	 */
	public Integer criarArtigo(String descricao) {
		
		Artigo art = new Artigo(descricao, this ,this.artigos.size());
		this.artigos.add(art);
		System.out.println("O artigo foi adicionado com sucesso");
		return art.obtemId();
	}
	
	
	/**
	 * Retira os artigos invalidos ou seja id=-1, da lista de artigos do utilizador
	 */
	public void retiraInvalidos() {
		
		ArrayList<Artigo> novo = new ArrayList<Artigo>();
		int i = 0;
		for (Artigo a: this.artigos) {
			if (a.obtemId() != -1) {
				novo.add(a);
				a.alteraId(i);
				i++;
			}
		}
		this.artigos = novo;
	}
	
	
	/**
	 * Cria um leilao para o artigo com idArtigo e com a descricao spec
	 *
	 * @param spec      Descricao do artigo
	 * @param idArtigo  Id do artigo a leiloar
	 * @return          id do leilão
	 */
	public Integer criarLeilao(String spec, int idArtigo) {
		
		try {
			
			Artigo art = this.artigos.get(idArtigo);

			if (this.validaVendedor()) {
				Leilao l = new Leilao(spec, this, art);
				System.out.println("O seu leilão foi criado com sucesso!");
				return this.catalogoDeLeiloes.adicionaLeilao(l);
			}else {
				System.out.println("O seu leilão não foi criado pois a sua reputação está no nivel mau");
				return -1;
			}
		}catch (Exception e){
			if (this.artigos.size() == 0) {
				System.out.println("O seu leilão não foi criado pois não tem nenhum artigo no seu catálogo de artigos");
				return -1;
			}else if (idArtigo == 0) {
				System.out.println("O seu leilão não foi criado pois o artigo já foi leiloado");
				return -1;	
			}else {
				System.out.println("O seu leilão não foi criado pois não tem nenhum artigo com o id: " + idArtigo + ", consulte os seus artigos.");
				return -1;
			}
		}
		
	}
	
	
	/**
	 * Configura um leilao de id idLeilao atribuindo-lhe uma data para
	 * terminar: dataFim e um preco onde iniciar as licitacoes: precoBase
	 *
	 * @param idLeilao  Id do leilao a configurar
	 * @param dataFim   Data em que se encerra o leilao
	 * @param precoBase Preco em que se inicia o leilao
	 */
	public void configurarLeilao(Integer idLeilao, String dataFim, int precoBase) {
		
		try{
			Leilao l = catalogoDeLeiloes.obtemLeilao(idLeilao);
			if (l.obtemUser().obtemId() != this.idUser) {
				System.out.println("Não tem autoridade para configurar este leilão");
			}else if(l.obtemStatusLeilao() == StatusDoLeilao.Criado) {
				l.configura(dataFim, precoBase);
				System.out.println("O leilão foi configurado com sucesso!");
			}else {
					System.out.println("O leilão não está no estado: Criado, e por isso não pode ser configurado");
			}
		}catch (Exception e) {
			if (this.catalogoDeLeiloes.obtemLeiloesVendedor(this.idUser).size() == 0) {
				System.out.println("O seu leilão não foi configurado pois não tem nenhum leilão criado.");
			}else {
				System.out.println("O seu leilão não foi configurado pois não existe nenhum leilão com o id: " + idLeilao + ", consulte os seus leilões.");
			}
		}

	}
	
	
	/**
	 * Publica o leilao com idLeilao
	 *
	 * @param idLeilao  Id do leilao a publicar
	 */
	public void publicaLeilao(Integer idLeilao) {
		
		try{
			Leilao l = catalogoDeLeiloes.obtemLeilao(idLeilao);
			if (l.obtemUser().obtemId() != this.idUser) {
				System.out.println("Não tem autoridade para publicar este leilão");
			}else if(l.obtemStatusLeilao() != StatusDoLeilao.Configurado) {
				System.out.println("O leilão não está no estado: Configurado, e por isso não pode ser publicado");
			}else {
				l.publica();
				System.out.println("O leilão foi publicado com sucesso!");
			}
		}catch (Exception e) {
			if (this.catalogoDeLeiloes.obtemLeiloesVendedor(this.idUser).size() == 0) {
				System.out.println("O seu leilão não foi configurado pois não tem nenhum leilão criado.");
			}else {
				System.out.println("O seu leilão não foi publicado pois não existe nenhum leilão com o id: " + idLeilao + ", consulte os seus leilões.");
			}
		}
	}

	
	/**
	 * Concretiza uma licitacao no leilao com idLeilao
	 *
	 * @param idLeilao  Id do leilao onde se vai licitar
	 * @param quantia   Quantia a ser licitada
	 */
	public void licitarLeilao(Integer idLeilao, int quantia) {
		
		try {
			Leilao l = catalogoDeLeiloes.obtemLeilao(idLeilao);
			
			if (l.obtemUser().obtemId() == this.idUser) {
				System.out.println("Não pode licitar no seu próprio leilão");
			}else if(l.obtemStatusLeilao() != StatusDoLeilao.Decorrer) {
				System.out.println("O leilão não está no estado: 'A decorrer', e por isso não pode licitar");
			}else if (l.obtemStatusLeilao() == StatusDoLeilao.Inválido) {
				System.out.println("O leilão é inválido, devido à má reputação do vendedor");
			}else {
				Licitacao licitacao = new Licitacao(this, quantia, l);
				if(l.validaLicitacao(licitacao)) {
					l.concretizaLicitacao(licitacao);
					System.out.println("A licitação foi feita com sucesso!");
				}
			}
		}catch (Exception e) {
			System.out.println("A licitação não foi efetuada pois o leilão com o id: " + idLeilao + " não existe, consulte os leilões ativos no Catálogo de Leilões.");
		}
	}
	
	
	/**
	 * Encerra o leilao com idLeilao
	 *
	 * @param idLeilao  Id do leilao a encerrar
	 */
	public void encerraLeilao(Integer idLeilao) {
		
		try {
			Leilao l = catalogoDeLeiloes.obtemLeilao(idLeilao);
			if (l.obtemUser().obtemId() != this.idUser) {
				System.out.println("Não tem autoridade para encerrar este leilão");
			}else if(l.obtemStatusLeilao() != StatusDoLeilao.Decorrer) {
				System.out.println("O leilão não está no estado: A decorrer, e por isso não pode ser encerrado");
			}else {
				l.fechar();
				////////////////////////////////////////////////////////////////////
				Artigo artigo = l.obtemArtigo();
				artigo.invalidaArtigo();

				this.retiraInvalidos();
				
			}
		}catch (Exception e) {
			System.out.println("O leilão não foi encerrado pois o leilão com o id: " + idLeilao + " não existe, consulte os leilões ativos no Catálogo de Leilões.");
		}
	}
	
	
	/**
	 * Arquiva o leilao com idLeilao
	 *
	 * @param idLeilao  Id do leilao a arquivar
	 */
	public void arquivaLeilao(Integer idLeilao) {
		
		Leilao l = catalogoDeLeiloes.obtemLeilao(idLeilao);
		if (l.obtemUser().obtemId() != this.idUser) {
			System.out.println("Não tem autoridade para arquivar este leilão");
		}else if(l.obtemStatusLeilao() != StatusDoLeilao.Terminado) {
			System.out.println("O leilão não está no estado: Terminado, e por isso não pode ser encerrado");
		}else {
			l.arquivar();
			System.out.println("O leilão foi arquivado com sucesso!");
		}
	}
	

	/**
	 * Adiciona a um reputacao rep `a lista de reputacoes do user
	 *
	 * @param rep  reputacao a adicionar `a lista de reputacoes
	 */
	public void adicionaReputacao(Reputacao rep) { reputacoes.add(rep); }
	
	
	/**
	 * Devolve uma representacao textual do utilizador
	 *
	 * @return Informacao sobre o utilizador
	 */
	public String toString() {
		
		StringBuilder s = new StringBuilder();
		s.append("Nome: " + this.nome + "\n");
		s.append("Id: " + this.idUser + "\n");
		s.append("Reputação: " + this.obtemReputacao() + "\n");
		return s.toString();	
	}


	/**
	 * Formulario para avaliar o utilizador
	 *
	 * @param ler       Avaliacao atribuida
	 * @param leilaoId  Id do leilao em que se avalia o user
	 * @return 			Reputacao do utilizador
	 */
	public Reputacao formularioReputacaoInterativo(Scanner ler, int leilaoId) {
		
		while(true) {
			System.out.print("Qual a reputacao a dar no leilao " + leilaoId + " (1-4)?");
			int rep = ler.nextInt();
			if(rep >= 1 && rep <= 4)
				return Reputacao.getReputacao(rep);
			System.out.println("Reputacao tem que ser entre 1 e 4");
		}
	}

	/**
	 * Formulario para avaliar o utilizador
	 *
	 * @param leilaoId  Id do leilao ...
	 * @param reputacao ...
	 * @return 			Reputacao do utilizador
	 */
	public Reputacao formularioReputacao(int leilaoId, Reputacao reputacao) {
		return reputacao;
	}
}