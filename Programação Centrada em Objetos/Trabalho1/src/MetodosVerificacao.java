import java.util.Arrays;

/**
 * Esta classe contem os metodos que serao usados para construir o programa principal PCOFase1 
 * 
 * @author Grupo14: MadalenaRodrigues_55853, PedroAlmeida_56897, RomuloNogueira_56935
 * @date Outubro 2021
 */

public class MetodosVerificacao {

	//	UTILS: ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		
	/**
	 * Orienta o trajeto com base no sentido passado como argumento
	 * 
	 * @param trajeto  O trajeto em questao
	 * @param sentido  O sentido a considerar no trajeto para a verificacao
	 * @return O trajeto orientado tendo em conta o sentido passado como parametro
	 */
	public static String[] orientaTrajeto(String[] trajeto, String sentido) {
		  
		return sentido.equals("REGULAR") ? trajeto : inverteVetor(trajeto);	
	}	
	
	
	/**
	 * Inverte a ordem dos elementos de um vetor 
	 * 
	 * @param vetor  vetor que se deseja inverter 
	 * @return vetor com os elementos do vetor original invertidos 
	 */
	public static String [] inverteVetor (String[] vetor) {

		String [] vetorInvertido = new String [vetor.length];
        int contador = 0;

        for (int i = vetor.length-1; i >= 0; i--) {

            vetorInvertido[contador] = vetor[i];
            contador++;

        } return vetorInvertido;
    }

	/**
	 * Separa a informaçao passada na propriedade em varias partes
	 * 
	 * @param propriedade  A propriedade a ser verificada
	 * @requires propriedade e’ da forma k1:prop1;...;kn:propn onde cada ki e’
	 * um inteiro e cada propi e’ uma sequencia de caracteristicas da
	 * forma caract1,...,caractm
	 * @return vetor de vetores, em que cada sub-vetor contem informaçao 
	 * relativa a cada parte da propriedade
	 */
	public static String [][] auxiliarDeDivisao (String propriedade){
			
			String [] partesPropriedade = propriedade.split(";");
			String[][] resultado = new String [partesPropriedade.length][];
			
			for (int i = 0; i < partesPropriedade.length; i++) {
							
				resultado[i] = partesPropriedade[i].split(":");
				
			} return resultado;
		}
	
	
	/**
	 * Separa os indices a analisar das caracteristicas a analisar 
	 * (provenientes da propriedade) e cria um vetor com eles
	 * 
	 * @param propriedade  A propriedade a ser verificada
	 * @requires propriedade e’ da forma k1:prop1;...;kn:propn onde cada ki e’
	 * um inteiro e cada propi e’ uma sequencia de caracteristicas da
	 * forma caract1,...,caractm
	 * @return vetor de inteiros com os indices a analisar 
	 */
	public static int [] divideNumeros (String propriedade) {

		String [][] propriedadesDivididas = auxiliarDeDivisao(propriedade);
		int [] resultado = new int [propriedadesDivididas.length];
		int cont = 0;
		
		for (String [] linha : propriedadesDivididas) {
		
			resultado[cont] = Integer.parseInt(linha[0]);
			cont ++;
			
		} return resultado;
	}	
	
	
	/**
	 * Separa as caracteristicas dos indices a analisar 
	 * (provenientes da propriedade) e criar um vetor com estas
	 * 
	 * @param propriedade  A propriedade a ser verificada
	 * @requires propriedade e’ da forma k1:prop1;...;kn:propn onde cada ki e’
	 * um inteiro e cada propi e’ uma sequencia de caracteristicas da
	 * forma caract1,...,caractm
	 * @return vetor de strings com a informaçao a analisar 
	 * 
	 */
	public static String [][] divideStrings (String propriedade) {
			
		String [][] propriedadesDivididas = auxiliarDeDivisao(propriedade);
		String [] caracteristicasAnalisar = new String [propriedadesDivididas.length];
		int i = 0;
		
		for (String [] linha : propriedadesDivididas) {
			
			caracteristicasAnalisar[i] = linha[1];
			i++;
		} 
		
		String [][] resultado = MetodosVerificacao.criaVetor(caracteristicasAnalisar);
		
		for (int linha = 0; linha < resultado.length; linha++) {
			for (int coluna = 0; coluna < resultado[linha].length; coluna++) {
				
				resultado[linha][coluna] = caracteristicasAnalisar[linha].split(",")[coluna];	
				
			}
		} return resultado;
	}
	
	
	/**
	 * Transforma um vetor num vetor de vetores a null para que posteriormente seja 
	 * preenchido
	 * 
	 * @param vetor  vetor de vetores a transformar num vetor unico
	 * @return vetor transformado
	 */
	public static String [][] criaVetor(String[] vetor) {
		
		String [][] novoVetor = new String [vetor.length][];

		for (int linha=0; linha<vetor.length; linha++) { 
			
			novoVetor[linha] = new String [vetor[linha].split(",").length];
				
		} return novoVetor;
	}


	//	PRINCIPAL: ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	/**
	* Um dado trajeto, num dado sentido, satisfaz uma dada propriedade?
	* 
	* @param trajeto  O trajeto em questao
	* @param propriedade  A propriedade a ser verificada
	* @param sentido  O sentido a considerar no trajeto para a verificacao
	* @requires trajeto != null && propriedade != null &&
	* sentido in {"REGULAR","INVERSO"} &&
	* os elementos de trajeto são sequencias de caracteristicas da
	* forma caract1,...,caractm
	* propriedade e’ da forma k1:prop1;...;kn:propn onde cada ki e’
	* um inteiro e cada propi e’ uma sequencia de caracteristicas da
	* forma caract1,...,caractm
	*/
	public static String verificaPropriedade(String[] trajeto, String propriedade, String sentido) {
			
		// Orienta o trajeto e define qual e' o primeiro planeta deste
		String [] novoTrajeto = orientaTrajeto(trajeto, sentido);
	    String primeiroPlaneta = novoTrajeto[0]; 
	    
	    // Separa os elementos da propriedade 
	    int[] indices = divideNumeros(propriedade); 
		String [][] caracteristicasPropriedade = divideStrings(propriedade); 

		// Definiçao inicial do resultado do programa
		String resultado  = "true";

		// Define o planeta corrente (inicialmente e' o que corresponde ao primeiro indice da propriedade)
		String planetaCorrente = novoTrajeto[determinaDistanciaPlanetaCorrente(novoTrajeto, primeiroPlaneta, indices[0])];
		
		int cont = 1;
		
		// Corre o programa uma vez para cada planeta dado na propriedade
		for (int i = 0; i < indices.length && resultado.equals("true"); i++) {

			Boolean resultadoDaVerificacao = verificaCaracteristicas(caracteristicasPropriedade, i , 
											 Arrays.asList(novoTrajeto).indexOf(planetaCorrente), novoTrajeto);

			if (resultadoDaVerificacao == true && cont < indices.length) {
				
				planetaCorrente = novoTrajeto[determinaDistanciaPlanetaCorrente(novoTrajeto, planetaCorrente, indices[cont])];
				cont ++;
				
			} else if (resultadoDaVerificacao == false){
				
				resultado = "false";
				
			}
		} return resultado;
	}
		
	
	/**
	 * Verifica se as características a cumprir sao cumpridas pelo planeta
	 * 
	 * @param caracteristicasPropriedade  vetor de vetores com a informaçao de cada planeta da propriedade
	 * @param indiceListaIndices  indice do planeta da lista das propriedades que tem de ser analisado
	 * @param indicePlanetaCorrente  indice do planeta que e' atualmente o corrente
	 * @param trajeto  O trajeto em questao
	 * @requires indiceListaIndices && indicePlanetaCorrente >= 0
	 * @return boolean que corresponde à veracidade da comparação
	 */
	 public static Boolean verificaCaracteristicas(String[][] caracteristicasPropriedade, int indiceListaIndices , int indicePlanetaCorrente, String [] trajeto){  // Só vê para um planeta  de cada vez

	    // Define a lista e a quantidade de condiçoes que vao ter de ser cumpridas para um dado planeta 
        String [] caracteristicasACumprir = caracteristicasPropriedade[indiceListaIndices]; 
        int quantidadeCondicoes = caracteristicasACumprir.length; 

        // Define as caracteristicas de cada planeta
        String[] caracteristicasPlanetaSeparadas = (trajeto[indicePlanetaCorrente]).split(",");

        int contador = 0;

        // Verifica a igualdade das condiçoes e se ja foram todas verificadas
        for (int i = 0; i < quantidadeCondicoes; i++){ 
            for (int j = 0; j<caracteristicasPlanetaSeparadas.length; j++){

                String [] caracteristica = new String[1]; 
                caracteristica[0] = caracteristicasPlanetaSeparadas[j];


                if ((trajeto[indicePlanetaCorrente]).contains(caracteristicasACumprir[0])){
                    
                	contador += 1;
                    if (contador == quantidadeCondicoes){  
                    	
                        return true; 
                    }
                }
            }
        } return false;
    }

	/**
	 * Determina o indice do planeta cujas caracteristicas vao ser comparadas com as passadas na propriedade, 
	 * tendo em conta a circularidade do percurso
	 * 
	 * @param percurso  vetor que contem as informaçoes sobre cada planeta que se deseja visitar
	 * @param planetaCorrente  planeta que e' atualmente o corrente
	 * @param indiceListaIndices  indice do planeta da lista das propriedades que tem de ser analisado
	 * @requires indiceListaIndices && indicePlanetaCorrente >= 0
	 * @return indice do proximo planeta a analisar
	 */
    public static int determinaDistanciaPlanetaCorrente(String[] percurso,String planetaCorrente, int indiceListaIndices) {
              
	 	// Atualiza o planeta corrente 
	    int indicePlanetaCorrente = Arrays.asList(percurso).indexOf(planetaCorrente);
	    
	    // Determina o novo planeta a analisar com base no planeta corrente e no indice das 
	    // propriedades a ser analisado atualmente
	    int novoIndice = indicePlanetaCorrente + indiceListaIndices;
	    
	    // Resoluçao do problema da ultrapassagem do final do percurso
	    if(novoIndice >= percurso.length) {  
	    	
	    	int resultado = Math.abs(percurso.length - novoIndice);
	        while(resultado >= percurso.length) {
	        	
	            resultado = Math.abs(percurso.length - resultado);
	            
	        } return resultado; 
	        
	    } else { return novoIndice; }
   }
}
	
