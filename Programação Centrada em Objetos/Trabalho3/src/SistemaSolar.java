import java.util.List;

/**
 * @author MadalenaRodrigues_55853, PedroAlmeida_56897, RómuloNogueira_56935
 * @date Dezembro 2021
 */

public interface SistemaSolar {

	/**
	 * Devolve o nome do sistema solar
	 */
	
	public String nome();
	
	
	/**
	 * Devolve true se é possível visitar todos os elementos do sistema solar correspondentes 
	 * aos números de ordem contidos na lista aVisitar
	 * @param aVisitar
	 */
	
	public boolean podeVisitar(List <Integer> aVisitar);
	
	
	/**
	 * Devolve o número de elementos que este sistema solar define
	 */
	
	public int quantosElementos();
	
	
	/**
	 * Devolve o corpo celeste deste sistema solar correspondente ao número de ordem n
	 * @param n
	 */
	
	public CorpoCeleste getElemento(int n);
	
	
	/**
	 * Devolve o buraco negro deste sistema solar que se encontra mais perto do corpo celeste c
	 * @param c
	 */
	
	public BuracoNegro buracoNegroMaisPerto(CorpoCeleste c);
	
}
