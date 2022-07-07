import java.util.List;

/**
 * Esta classe subclasse de AbstractSistemaSolar, cujas instâncias representam sistemas solares 
 * em que os corpos celestes estão organizados numa matriz e a sua ordem depende da forma como 
 * esta matriz é “percorrida” (definida através de um Direcionador).
 * Na matriz podem existir buracos negros, corpos celestes vulgares e elementos a null,
 * representando ausência de corpo celeste.
 * 
 * @author MadalenaRodrigues_55853, PedroAlmeida_56897, RómuloNogueira_56935
 * @date Dezembro 2021
 */

public class Sistema2D extends AbstractSistemaSolar{

	// ATRIBUTOS
	private CorpoCeleste [][] m;
	private Direcionador d;
	
	
	/* Construtor que inicializa um novo objeto com nome nome, uma matriz de corpos celestes igual 
	 * a m e um direcionador igual a d;
	 * 
	 * @param m  matriz de corpos celestes
	 * @param d  direcionador que define o forma como a matriz é ercorrida
	 */
	
	public Sistema2D(String nome, CorpoCeleste [][] m, Direcionador d) {
		
		super(nome);
		this.m = m;
		this.d = d;
		
		// Inicialização do Direcionador
		this.d.defineUniverso(m);
	}

	
	/*
	 * Devolve o número de elementos da matriz deste sistema 2D
	 * 
	 * @return  número de elementos
	 */
	@Override
	public int quantosElementos() {

		int result = 0;
		
		for (int linha = 0; linha < this.m.length ; linha++) {
			
			for (int coluna = 0; coluna < this.m[linha].length; coluna++) {
				
				result ++;
			}
		}
		return result;
	}
	
	
	
	/*
	 * Devolve o corpo celeste da matriz deste sistema solar correspondente ao número de ordem n,
	 * tal como calculado pelo direcionador associado a este sistema 2D
	 * 
	 * @param n  número de ordem do elemento
	 * @requires n >= 0
	 * @return  corpo celeste de ordem n  
	 */
	@Override
	public CorpoCeleste getElemento(int n) {

		return this.d.nEsimoElemento(n);
	}
	
	
	/*
	 * Devolve o buraco negro deste sistema solar que se encontra mais perto do corpo celeste c
	 * 
	 * @param c  corpo celeste em relação ao qual se quer encontrar o buraco negro mais proximo
	 * @return  qual o buraco negro mais próximo de c 
	 */
	@Override
	public BuracoNegro buracoNegroMaisPerto(CorpoCeleste c) {
		
		BuracoNegro maisproximo = null;
		double distancia = Double.MAX_VALUE;
		
		for (int i = 1; i < this.quantosElementos() + 1; i ++) {
			
			CorpoCeleste corpo = this.getElemento(i);

			if (corpo != null && corpo.getClass().getName() == "BuracoNegro" && 
				distancia > c.distancia(corpo)) {
				
				maisproximo = (BuracoNegro) corpo;
				distancia = c.distancia(corpo);
			}
			
		}
		return maisproximo;
	}
	
	
	/*
	 * Devolve true se todos os inteiros contidos na lista aVisitar são maiores que zero e menores ou
	 * iguais a quantosElementos() e se todos os elementos da matriz correspondentes aos números de 
	 * ordem em aVisitar são corpos celestes vulgares (não são buracos negros nem null)
	 * 
	 * @param aVisitar  lista com as posições dos corpos celestes a visitar
	 * @requires  aVisitar != null
	 * @return  true se o corpo celeste pode ser visitado, false se não pode
	 */
	@Override
	public boolean podeVisitar(List<Integer> aVisitar) {

		int dimensao = this.quantosElementos();

		for (int n: aVisitar) {
			
			if (n <= 0 || n > dimensao || this.getElemento(n) == null ||
				this.getElemento(n).getClass().getName() == "BuracoNegro") {
				
				return false;
			}
			
		}
		return true;
	}
	
	
	/*
	 * Devolve a representação textual do sistema solar
	 */
	
	public String toString() {

		StringBuilder resultado = new StringBuilder ("Nome: " + this.nome() + "\n");
		
		resultado.append("Direcionador: " + this.d.getClass().getName() + "\n");
		
		for (int i = 0; i < this.m.length; i++) {
			for (int j = 0; j < this.m[i].length; j++) {
				
				CorpoCeleste c = this.m[i][j];
				
				if (c != null && c.getClass().getName() == "BuracoNegro") {
					
					resultado.append(" B" + c.posicao() + " ");
				}
				else if(c != null){
					
					resultado.append(" " + c.posicao() + " ");
				}
				else {
					
					resultado.append(" null ");
				}
			}
			resultado.append("\n");
		}
		return resultado.toString();
	}
}
