/**
 * Esta classe implementa o interface Direcionador
 * 
 * @author MadalenaRodrigues_55853, PedroAlmeida_56897, RómuloNogueira_56935
 * @date Dezembro 2021
 */

public class LagartaVertical implements Direcionador {

	// ATRIBUTOS
	private CorpoCeleste[][] matriz;
	
	/**
	 * Define o universo sobre o qual o direcionador vai trabalhar como sendo m
	 * 
	 * @param m  matriz que contem os corpos celestes
	 */
	@Override
	public void defineUniverso(CorpoCeleste[][] m) {
		
		this.matriz = m;
	}

	
	/**
     * Método auxiliar que calcula a quantidade de corpos celestes de um objeto
     * 
     * @return  Número de corpos celestes de um objeto
  	 */
	
	private int numeroDePlanetas() {
		
		int resultado = 0;
		
		for (int i = 0; i < this.matriz.length; i++) {
			
			for (int j = 0; j < this.matriz[i].length; j++) {
				
				resultado ++;
			}
		}
		return resultado;
	}
	
	
	/**
     * Método auxiliar que transpõe a matriz de corpos celestes
     * 
     * @param m  matriz que se pretende transpor
     * @return  matriz transposta
  	 */
	
	private static CorpoCeleste[][] transpoe(CorpoCeleste[][] m){
		
		CorpoCeleste [][] result = new CorpoCeleste[m[0].length][m.length];
		
		for (int linha = 0; linha < m.length; linha++) {
			
			for (int coluna = 0; coluna < m[linha].length; coluna++) {
				
				result[coluna][linha] = m[linha][coluna];
			}
		}
		return result;
	}
	
	
	/*
	 * Retorna o elemento na posição n da matriz universo, de acordo com a estratégia de lagarta vertical
	 * 
	 * @param n  número de ordem do elemento
	 * @requires n >= 0
	 * @return  corpo celeste de ordem n  
	 */
	@Override
	public CorpoCeleste nEsimoElemento(int n) { 

		int maximo = this.numeroDePlanetas() + 1;

		if (n >= maximo) {
			
			n = n % maximo;
		}
		
		CorpoCeleste corpoC = null;
		CorpoCeleste [][] matrizTransposta = transpoe(this.matriz);
		
		int contador = 0;
		
		for (int i = 0; i < matrizTransposta.length; i++) {
			
			if (i%2 == 0 || i == 0) {
				
				for (int j = 0; j < matrizTransposta[i].length; j++) {
					
					contador++;
					
					if (contador == n) {
						
						corpoC = matrizTransposta[i][j];
					}
				}
			}
			else {
				
				for (int j = matrizTransposta[i].length - 1; j >= 0; j--) {
					
					contador++;
					
					if (contador == n) {
						
						corpoC = matrizTransposta[i][j];
					}
				}

			}
		}
		return corpoC;
	}

}
