/**
 * Esta classe permite testar a funcao verificaPropriedade  
 * da classe MetodosVerificacao
 * 
 * @author minunes
 * @date Outubro 2021
 */
public class PCOFase1 {

	/**
	 * Aqui invoca-se a funcao verificaPropriedade da classe 
	 * MetodosVerificacao para varios valores dos seus parametros e   
	 * imprimem-se os resultados no standard output
	 * @param args Nao utilizado
	 */
	public static void main(String[] args) {
		String [] percurso1 = {
				"isFriendly,hasWater",
				"hasLight,hasWater,isFriendly",
				"hasWater,hasFood,isFriendly,canRefuel", 
				"hasLight,hasWater,canBreathe",
				"canBreathe", 
				"hasWater,isFriendly,hasLight"
		};

		String propriedade = "0:hasWater;2:canRefuel,isFriendly;3:hasWater,hasLight";
		System.out.println("Resultado correto e': true. O vosso resultado e': " +
				MetodosVerificacao.verificaPropriedade(percurso1, propriedade, "REGULAR"));
		System.out.println("Resultado correto e': false. O vosso resultado e': " +
				MetodosVerificacao.verificaPropriedade(percurso1, propriedade, "INVERSO"));

		propriedade = "1:canBreathe;4:hasWater,isFriendly";
		System.out.println("Resultado correto e': false. O vosso resultado e': " +
				MetodosVerificacao.verificaPropriedade(percurso1, propriedade, "REGULAR"));
		System.out.println("Resultado correto e': true. O vosso resultado e': " +
				MetodosVerificacao.verificaPropriedade(percurso1, propriedade, "INVERSO"));

		propriedade = "2:canRefuel;2:canBreathe;3:hasLight,isFriendly,hasWater";
		System.out.println("Resultado correto e': true. O vosso resultado e': " +
				MetodosVerificacao.verificaPropriedade(percurso1, propriedade, "REGULAR"));
		System.out.println("Resultado correto e': false. O vosso resultado e': " +
				MetodosVerificacao.verificaPropriedade(percurso1, propriedade, "INVERSO"));

		propriedade = "2:hasLight,canBreathe;3:isFriendly;2:canBreathe";
		System.out.println("Resultado correto e': false. O vosso resultado e': " +
				MetodosVerificacao.verificaPropriedade(percurso1, propriedade, "REGULAR"));
		System.out.println("Resultado correto e': true. O vosso resultado e': " +
				MetodosVerificacao.verificaPropriedade(percurso1, propriedade, "INVERSO"));

		
		String [] percurso2 = {
				"hasLight,hasWater,canBreathe",
				"hasWater,hasFood,isFriendly,canRefuel", 
				"", 
		};

		propriedade = "1:hasFood,canRefuel;6:isFriendly,hasWater;2:canBreathe";
		System.out.println("Resultado correto e': true. O vosso resultado e': " +
				MetodosVerificacao.verificaPropriedade(percurso2, propriedade, "REGULAR"));
		System.out.println("Resultado correto e': false. O vosso resultado e': " +
				MetodosVerificacao.verificaPropriedade(percurso2, propriedade, "INVERSO"));

	}
}