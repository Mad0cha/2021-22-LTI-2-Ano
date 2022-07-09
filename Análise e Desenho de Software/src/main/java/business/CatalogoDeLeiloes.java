package business;

/**
 * <p>CatalogoDeLeiloes class.</p>
 *
 * @author Grupo12: MadalenaRodrigues_55853, PedroAlmeida_56897, RomuloNogueira_56935
 * @version $Id: $Id
 */

import java.util.HashMap;
import java.util.Map;
import java.util.Map.Entry;

/**
 * Classe que trata do catalogo de leiloes de um utilizador
 *
 */
public class CatalogoDeLeiloes {
		
	private static Map<Integer, Leilao> meusLeiloes = new HashMap<Integer, Leilao>();
	private static Integer indice = 0;
	
	
	/**
	 * Adiciona o leilao l aos leiloes de um utilizador
	 *
	 * @param l   Leilao que se pretende adicionar
	 * @return    id do leilao
	 */
	public Integer adicionaLeilao(Leilao l) {
		
		CatalogoDeLeiloes.indice++;
		meusLeiloes.put(indice,l);
		return indice;
	}
	
	
	/**
	 * Adiciona o leilão l aos leilões de um utilizador
	 *
	 * @param idLeilao id do leilao que se quer obter do catalogo
	 * @return    	   O leilão correspondente a idLeilao
	 */
	public Leilao obtemLeilao(Integer idLeilao) { return CatalogoDeLeiloes.meusLeiloes.get(idLeilao); }
	
	
	/**
	 * Obtem os leiloes de um certo vendedor
	 *
	 * @param  idUser   id do vendedor do qual pretendemos obter os leiloes
	 * @return leiloes do vendedor idUser
	 */
	public HashMap<Integer, Leilao> obtemLeiloesVendedor(int idUser){
		
		HashMap<Integer, Leilao> res = new HashMap<Integer, Leilao>();
		
		for (Entry<Integer, Leilao> e : CatalogoDeLeiloes.meusLeiloes.entrySet()) {
			if (e.getValue().obtemUser().obtemId() == idUser) {
				res.put(e.getKey(), e.getValue());
			}
		}
		return res;
	}
	
	
	/**
	 * Devolve uma representacao textual do catalogo de leiloes
	 *
	 * @return leiloes no catalogo de leiloes
	 */
	public String toString() {
		
		StringBuilder s = new StringBuilder();
		s.append("==================== Catálogo de leilões ==================== \n");
		
		if (CatalogoDeLeiloes.meusLeiloes.size() > 0) {
			s.append("\n");
			for (Map.Entry<Integer, Leilao> entry : CatalogoDeLeiloes.meusLeiloes.entrySet()) {
				s.append("Leilão " + entry.getKey()  +"\n");
				s.append(entry.getValue().toString() + "\n");
				s.append("\n");
			}
		}else {
			s.append("Está vazio.");
		}          
		s.append("============================================================= \n");
		return s.toString();
	}	
	
}