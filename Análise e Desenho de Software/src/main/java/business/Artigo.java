package business;

/**
 * <p>Artigo class.</p>
 *
 * @author Grupo12: MadalenaRodrigues_55853, PedroAlmeida_56897, RomuloNogueira_56935
 * @version $Id: $Id
 */

/**
 * Classe que gere um artigo
 *
 */
public class Artigo {

	private User user;
	private int idArtigo;
	private String descricao;
	
	
	/**
	 * Construtor de um artigo.
	 *
	 * @param descricao Descri�ao do artigo
	 * @param user      User associado ao artigo
	 * @param idArtigo  Id associado ao artigo
	 */
	public Artigo(String descricao, User user, int idArtigo) {
		
		this.user = user;
		this.idArtigo = idArtigo;
		this.descricao = descricao;
	}
	
	
	/**
	 * Os seguintes metodos sao getters e servem para obter 
	 * informacao relativa ao artigo
	 */
	
	
	/**
	 * Metodo para obter o utilizador associado ao artigo
	 *
	 * @return o User
	 */
	public User obtemUser() { return this.user; }
	
	
	/**
	 * Metodo para obter o id do artigo
	 *
	 * @return o id do artigo
	 */
	public int obtemId() { return this.idArtigo; }
	
	
	/**
	 * Metodo para obter a descricao do artigo
	 *
	 * @return String correspondente `a descricao do artigo
	 */
	public String obtemDescricao() { return this.descricao; }
	
	
	/**
	 * Metodo que invalida um artigo atribuindo-lhe o id de '-1'
	 */
	public void invalidaArtigo() {
		
		this.idArtigo = -1;
	}
	
	
	/**
	 * Metodo que altera o id de um artigo
	 *
	 * @param i novo id
	 */
	public void alteraId(int i) {
		
		this.idArtigo = i;
	}
	

	/**
	 * Metodo que devolve uma representacao textual do artigo
	 *
	 * @return Informacao sobre um artigo
	 */
	public String toString() {
		
		StringBuilder s = new StringBuilder();
		s.append("Artigo pertencente a: " + this.user.obtemNome() + "\n");
		s.append("Id do artigo: " + this.idArtigo + "\n");
		s.append("Descrição do artigo: \n");
		s.append(this.descricao);
		return s.toString();
	}
	
}