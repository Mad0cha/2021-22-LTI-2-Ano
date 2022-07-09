package business;

/**
 * <p>Individual class.</p>
 *
 * @author Grupo12: MadalenaRodrigues_55853, PedroAlmeida_56897, RomuloNogueira_56935
 * @version $Id: $Id
 */

/**
 * Classe que extende um artigo 
 *
 */
public class Individual extends Artigo {

	/**
	 * Construtor de um artigo individual
	 *
	 * @param descricao Descrição do artigo
	 * @param user User associado ao artigo
	 * @param idArtigo id associado ao artigo
	 */
	public Individual(String descricao, User user, int idArtigo) {
		
		super(descricao,user, idArtigo);
	}
	
}