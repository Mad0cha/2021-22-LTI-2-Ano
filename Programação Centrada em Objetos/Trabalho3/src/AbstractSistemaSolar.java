import java.util.List;

/**
 * Esta classe implementa o interface SistemaSolar e define o que é comum a 
 * vários tipos de sistemas solares 
 * 
 * @author MadalenaRodrigues_55853, PedroAlmeida_56897, RómuloNogueira_56935
 * @date Dezembro 2021
 */

public abstract class AbstractSistemaSolar implements SistemaSolar {

	// Atributos
	private String nome;
	
	/**
	 * Construtor que inicializa um novo objeto com o nome "nome"
	 * @param nome  nome que o sistema solar irá ter
	 */
	
	public AbstractSistemaSolar(String nome) {
		
		this.nome = nome;
	}
	
	
	/**
	 * Devolve o nome do sistema solar
	 */
	@Override
	public String nome() {

		return this.nome;
	}
	
	
	/**
	 * Devolve true se todos os inteiros contidos na lista aVisitar são maiores que zero e menores
	 * ou iguais a quantosElementos()
	 * @param aVisitar  lista com as posições dos corpos celestes a visitar
	 * @requires aVisitar.size() > 0
	 */
	@Override
	public boolean podeVisitar(List<Integer> aVisitar) {
		
		for (int num : aVisitar) {
			
			if((num <= 0) || num > this.quantosElementos()) {
				return false;
			}
			
		}
		return true;
	}

	
	/**
	 * Devolve a representação textual correspondente ao nome do sistema solar
	 */
	
	public String toString() {
		
		return "Nome: " + this.nome;
	}
	
}
