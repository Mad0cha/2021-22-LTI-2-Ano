/**
 * Esta classe implementa o interface Direcionador
 * 
 * @author MadalenaRodrigues_55853, PedroAlmeida_56897, RómuloNogueira_56935
 * @date Dezembro 2021
 */

public class LagartaHorizontal implements Direcionador {

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

	
	/*
	 * Retorna o elemento na posição n da matriz universo, de acordo com a estratégia de lagarta horizontal
	 * 
	 * @param n  número de ordem do elemento
	 * @requires n >= 0
	 * @return  corpo celeste de ordem n  
	 */
	@Override
	public CorpoCeleste nEsimoElemento(int n) {
		
		int maximo = numeroDePlanetas() + 1;

		if (n >= maximo) {
			
			n = n % maximo;
		}
	
		CorpoCeleste corpo = null;
		int contador = 0;
		
		for (int i = 0; i < this.matriz.length; i++) {
			
			if (i%2 == 0 || i == 0) { // Se for par ou 0
				
				for (int j = 0; j < this.matriz[i].length; j++) {
					
					contador++;
					
					if (contador == n) {
						
						corpo = this.matriz[i][j];
					}
				}
			}
			else { // Se for ímpar
				
				for (int j = this.matriz[i].length - 1; j >= 0; j--) {
					
					contador++;
					
					if (contador == n) {
						
						corpo = this.matriz[i][j];
					}
				}
			}	
		}
		return corpo;
	}
	
}
