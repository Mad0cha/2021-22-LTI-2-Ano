/**
 * Classe cujas instâncias representam corpos celestes ou seja, corpos que têm uma massa e uma posição
 * num espaço tridimensional
 * 
 * @author MadalenaRodrigues_55853, PedroAlmeida_56897, RómuloNogueira_56935
 * @date Dezembro 2021
 */
public class CorpoCeleste {
	
	// ATRIBUTOS
	private double massa;
	private Ponto3D posicao;
	
	
	/*
	 * Construtor que inicializa um novo objeto com uma massa igual a massa e uma posição igual a pos
	 * @param massa  massa do corpo celeste	 
	 * @param pos  posição do corpo celeste	 
	 */
	
	public CorpoCeleste (double massa, Ponto3D pos) {
		
		this.massa = massa;
		this.posicao = pos;
	}


	/*
	 * Retorna a massa deste corpo celeste
	 */
	
	public double massa() {
	
		return this.massa;
	}
	
	
	/*
	 * Retorna a posição deste corpo celeste
	 */
	public Ponto3D posicao() {
		
		return this.posicao;
	}
	
	
	/*
	 * Retorna a distância deste corpo celeste a c
	 * @param c  corpo celeste sobre o qual se quer calcular a distância	
	 * @requires c != null 
	 * @return  distância entre os dois planetas
	 */
	
	public double distancia(CorpoCeleste c) {
		
		Ponto3D posC = c.posicao();
		Ponto3D posAtual = this.posicao(); 
		
		return posAtual.distancia(posC);
	}

	
	/*
	 * Retorna true se este corpo celeste tiver uma massa e uma posição iguais à massa e à posição de other,
	 * se other for um corpo celeste
	 * 
	 * @param other  corpo celeste que queremos comparar
	 * @return  distância entre os dois planetas
	 */
	public boolean equals(Object other) {
		
		if (other == null) {return false;}
		if (other == this) {return true;}
		if (!(other instanceof CorpoCeleste)) {return false;}
		
		CorpoCeleste cp = (CorpoCeleste) other;

		return this.posicao.equals(cp.posicao()) && (Math.abs(this.massa - cp.massa) < 0.0001);
	}
	
	/*
	 * Redifinição do hashCode 
	 */
	public int hashCode() {
		int result = 17;
		result = 37 * result + (int)(this.massa + 0.5);
		result = 37 * this.posicao.hashCode();
		return result;
	}
	
}
