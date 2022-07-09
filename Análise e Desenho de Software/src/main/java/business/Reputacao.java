package business;

/**
 * <p>Reputacao class.</p>
 *
 * @author Grupo12: MadalenaRodrigues_55853, PedroAlmeida_56897, RomuloNogueira_56935
 * @version $Id: $Id
 */

/**
 * Enumerado com as opcoes de reputacao possiveis
 */
public enum Reputacao {
	/**
	 * NAO_TEM (quando o utilizador acabou de ser criado)
	 */
	NAO_TEM(0), 
	/**
	 * MA (se for atribuido o valor 1 no formulario de reputacoes)
	 */
	MA(1), 
	
	/**
	 * SUFICIENTE (se for atribuido o valor 2 no formulario de reputacoes)
	 */
	SUFICIENTE(2), 
	/**
	 * BOA (se for atribuido o valor 3 no formulario de reputacoes)
	 */
	BOA(3), 
	/**
	 * EXCELENTE (se for atribuido o valor 4 no formulario de reputacoes)
	 */
	EXCELENTE(4);
	
	private int valor;
	
	/**
	 * Construtor da reputacao
	 */
	Reputacao(int valor) {
		
		this.valor = valor;
	}
	
	
	/**
	 * Metodo para obter o valor usado para calcular a reputacao
	 *
	 * @return valor da reputação
	 */
	public int getValor() { return valor; }
	
	
	/**
	 * Atribui a reputacao a um utilizador
	 *
	 * @param valor Data em que termina o leilao
	 * @return      reputacao do utilizador
	 */
	public static Reputacao getReputacao(int valor) {
		
		switch(valor) {
			case 1: return MA;
			case 2: return SUFICIENTE;
			case 3: return BOA;
			case 4: return EXCELENTE;
		}
		return NAO_TEM;
	}
	
}