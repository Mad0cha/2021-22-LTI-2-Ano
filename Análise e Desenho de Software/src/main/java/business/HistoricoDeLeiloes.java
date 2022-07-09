package business;

/**
 * <p>HistoricoDeLeiloes class.</p>
 *
 * @author Grupo12: MadalenaRodrigues_55853, PedroAlmeida_56897, RomuloNogueira_56935
 * @version $Id: $Id
 */

import java.util.ArrayList;
import java.util.List;

/**
 * Classe que gere o historico de leiloes de um utilizador 
 *
 */
public class HistoricoDeLeiloes {
	
	private static List<Leilao> leiloes = new ArrayList<Leilao>();
	
	/**
	 * Adiciona o leilao a `a lista de leiloes
	 *
	 * @param l   leilao a adicionar
	 */
	public void adicionarLeilao(Leilao l) { leiloes.add(l); }
	
	
	/**
	 * Remove o leilao a da lista de leiloes
	 *
	 * @param l   leilao a remover
	 */
	public void removerLeilao(Leilao l) { leiloes.remove(l); }
	
	
	/**
	 * Devolve uma representacao textual do historico de leiloes
	 *
	 * @return String que corresponde `a representacao textual do historico de leiloes
	 */
	public String toString() {
		
		StringBuilder s = new StringBuilder();
		s.append("==================== Histórico de leilões ==================== \n");
		
		if (HistoricoDeLeiloes.leiloes.size() > 0) {
			s.append("\n");
			for (int i = 0; i < HistoricoDeLeiloes.leiloes.size(); i++) {
				s.append("Leilão " + i  +"\n");
				s.append(HistoricoDeLeiloes.leiloes.get(i).toString() + "\n");
			}
		}else {
			s.append("Está vazio.");
		}
		return s.toString();
	}
	
}