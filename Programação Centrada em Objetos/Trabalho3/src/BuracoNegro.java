/**
 * Esta classe é uma subclasse de CorpoCeleste, cujas instâncias representam corpos celestes 
 * com uma massa tal, que faz com que tenham uma grande força de atração que pode provocar a 
 * destruição de outros corpos nas suas proximidades.
 * 
 * @author MadalenaRodrigues_55853, PedroAlmeida_56897, RómuloNogueira_56935
 * @date Dezembro 2021
 */

public class BuracoNegro extends CorpoCeleste{
	
	/*
	 * Construtor que inicializa um novo objeto com uma massa igual a massa e uma posição igual a pos
	 * @param massa  massa do corpo celeste	 
	 * @param pos  posição do corpo celeste	 
	 */
	
	public BuracoNegro(double massa, Ponto3D pos) {
		
		super(massa, pos);
	}

	
	/*
	 * Retorna o valor da distância mínima a que um outro corpo celeste tem que estar
	 * para não ser muito afetado pela força de atração deste buraco negro
	 * 
	 * @param c  corpo celeste sobre o qual se quer calcular a distância mínima de segurança
	 * @requires c != null	
	 * @return  distância entre os dois planetas
	 */
	
	public double distanciaMinimaSeguranca(CorpoCeleste c) {
		
		return Math.sqrt(this.massa() * c.massa());
	}
	
}
