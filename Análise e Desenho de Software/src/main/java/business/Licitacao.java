package business;

/**
 * <p>Licitacao class.</p>
 *
 * @author Grupo12: MadalenaRodrigues_55853, PedroAlmeida_56897, RomuloNogueira_56935
 * @version $Id: $Id
 */

import java.text.SimpleDateFormat;
import java.util.Date;

/**
 * Classe que gere uma licitacao
 *
 */
public class Licitacao {
	
	private Leilao leilao;
	private Date timestamp;
	private int quantia;
	private User user;
	
	
	/**
	 * Construtor de uma licitacao
	 *
	 * @param user    utilizador que fez a licitacao
	 * @param quantia a quantia da licitacao
	 * @param leilao  leilao onde foi feita a licitacao
	 */
	public Licitacao(User user, int quantia, Leilao leilao) {
	
		this.leilao = leilao;
		this.timestamp = new Date();
		this.quantia = quantia;
		this.user = user;
	}
	
	
	/**
	 * Os seguintes metodos sao getters e servem para obter 
	 * informacao relativa `a licitação
	 */
	
	/**
	 * Metodo para obter o leilao onde foi feita a licitacao
	 *
	 * @return o leilao onde foi feita a licitacao
	 */
	public Leilao obtemLeilao() { return this.leilao; }
	
	
	/**
	 * Metodo para obter o time stamp da licitacao
	 *
	 * @return o time stamp da licitação
	 */
	public Date obtemTimestamp() { return this.timestamp; }
	
	
	/**
	 * Metodo para obter a quantia licitada
	 *
	 * @return a quantia licitada
	 */
	public int obtemQuantia() { return this.quantia; }
	
	
	/**
	 * Metodo para obter o utilizador que fez a licitacao
	 *
	 * @return utilizador que fez a licitacao
	 */
	public User obtemUser() { return this.user; }
	
	
	/**
	 * Devolve uma representacao textual da licitacao
	 *
	 * @return Informacao sobre a licitacao
	 */
	public String toString() {
		
		StringBuilder s = new StringBuilder();
		s.append("Nome do licitador: " + this.user.obtemNome() + "\n");
		SimpleDateFormat dateFormatter = new SimpleDateFormat("dd/MM/yyyy HH:mm:ss");
		s.append("Hora da licitação: " + dateFormatter.format(this.timestamp) + "\n");	
		s.append("Valor da licitação:" + this.quantia);
		
		return s.toString();
	}
	
}