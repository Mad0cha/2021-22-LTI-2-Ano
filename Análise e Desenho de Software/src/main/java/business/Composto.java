package business;

/**
 * <p>Composto class.</p>
 *
 * @author Grupo12: MadalenaRodrigues_55853, PedroAlmeida_56897, RomuloNogueira_56935
 * @version $Id: $Id
 */

import java.util.ArrayList;
import java.util.List;

/**
 * Classe que extende um artigo 
 *
 */
public class Composto extends Artigo {
	
	private List<Artigo> artigos = new ArrayList<Artigo>();
	
	/**
	 * Construtor de um artigo composto
	 *
	 * @param descricao Descrição do artigo
	 * @param a         Lista de artigos que compoe o artigo composto
	 * @param user User associado ao artigo
	 * @param idArtigo  id associado ao artigo
	 */
	public Composto(String descricao, List<Artigo> a, User user, int idArtigo) {
		
		super(descricao, user, idArtigo);
		for (int i = 0; i < a.size(); i++) {
			this.artigos.add(a.get(i));
		}
	}
	

	/**
	 * Adiciona o artigo a `a lista de artigos
	 *
	 * @param a   Artigo a adicionar
	 */
	public void adicionar(Artigo a) {
		
		this.artigos.add(a);
	}
	
	
	/**
	 * Remove o artigo a da lista de artigos
	 *
	 * @param a   Artigo a remover
	 */
	public void remover(Artigo a) {
		
		this.artigos.remove(a);
	}
}