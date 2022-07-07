/**
 * @author MadalenaRodrigues_55853, PedroAlmeida_56897, RómuloNogueira_56935
 * @date Dezembro 2021
 */

public interface Direcionador {
	
	/**
	 * Define o universo sobre o qual o direcionador vai trabalhar como sendo m
	 */
	
	public void defineUniverso(CorpoCeleste [][] m);
	
	
	/**
	 * Devolve o elemento na posição n da matriz universo, de acordo com a estratégia de 
	 * direcionamento implementada pelo direcionador escolhido
	 */
	
	public CorpoCeleste nEsimoElemento(int n);

}
