import java.util.List;
import java.util.ArrayList;

/**
* @author MadalenaRodrigues_55853, PedroAlmeida_56897, RómuloNogueira_56935
* @date Novembro 2021
*/

public class SistemaSolar {
	
	// Variáveis da instância
	private String nome;
	private Planeta [][] planetas;
	
    /**
    * Construtor que inicializa um sistema solar cujo nome é o passado no argumento nome e 
	* contém uma matriz de planetas passada no argumento planetas
    * 
    * @param nome   Nome do Sistema Solar
    * @param planetas   Matriz que contém os planetas e as suas informações
    *
    * @requires universoValido(planetas) == true
    */
	public SistemaSolar(String nome, Planeta[][] planetas) { 
		 
		this.nome = nome;
		this.planetas =  planetas;
	}
	 
	 
	/**
    * Método que devolve true se o array bi-dimensional arrayBi é uma matriz e não contém
	* elementos a null
    * 
    * @param arrayBi   Matriz que contém os planetas e as suas informações
    * @return Retorna true ou false dependendo se há elementos a null e se a matriz arrayBi 
	* tem a mesma quantidade de elementos em todas as linhas.
	*/
	static boolean universoValido(Planeta[][] arrayBi) {
		
		int nColunasInicial = arrayBi[0].length;
		
		// Vê por linha se o número de colunas são o mesmo
		for (int i = 0; i < arrayBi.length; i++) {
			int colunas = arrayBi[i].length; 
			
	    	if (colunas != nColunasInicial){
	    		return false;
	    	}
			// Vê por coluna se o planeta é nulo 
	    	for (int j = 0; j < arrayBi[i].length; j++) {
	    		if(arrayBi[i][j].nome() == null) {
	    			return false;
	    		}
			}
	    }
		return true;
	}
	

	/**
	* Método que devolve o nome do sistema solar
	* 
	* @return nome do sistema solar sobre o qual se chama o método
	*/
	public String nome() {
		
		return this.nome;
	}
	

	/**
    * Método que devolve true se o sistema solar sobre o qual é aplicado contém um planeta 
	* cujo nome é o passado em nome
    * 
    * @param nome   Nome a verificar se existe
    * @return Retorna true ou false dependendo se existe o nome passado em nome no 
	* sistema solar
	*/
	public boolean temPlaneta(String nome) {
		
		for (int i = 0; i < this.planetas.length; i++) {
			for(int j = 0 ; j < this.planetas[i].length; j++) {
				if(this.planetas[i][j].nome().equals(nome)) {
					return true;
				}	
			}	
		}
		
		return false;
	}
	

	/**
    * Método que devolve uma lista contendo os nomes de todos os planetas do sistema solar
	* sobre o qual é aplicado que têm todas as propriedades referidas na lista props
    * 
    * @param propriedades   lista de propriedades a verificar 
    * @return Retorna quais os planetas que contém todas as propriedades 
	*/
    public List<String> comPropriedades(List<Propriedade> propriedades) {

        List<String> nomes = new ArrayList<>();

      	for (int i = 0; i < this.planetas.length; i++) {
        	for(int j = 0; j < this.planetas[i].length; j++) {
        		if(this.planetas[i][j].temTodas(propriedades)) {
        			nomes.add(this.planetas[i][j].nome());
        		}
        	}
      	}
        return nomes;
    }


	/**
    * Método que devolve um vetor em que o i-ésimo elemento representa o número de 
	* planetas do sistema solar sobre o qual é aplicado que têm a i-ésima propriedade 
	* do vetor Propriedade.values()
    * 
    * @return Número de planetas que têm a propriedade
 	*/
    public int[] quantosPorPropriedade() {

        Propriedade[] propriedades = Propriedade.values();
        int[] contagem = new int[propriedades.length];

        for (int i = 0; i < propriedades.length; i++) {

            List<Propriedade> p = new ArrayList<>();
            
			p.add(propriedades[i]);

            contagem[i] = this.comPropriedades(p).size();
        }
        return contagem;
    }

	
	/**
    * Método auxiliar que calcula a quantidade de planetas de um sistema solar
    * 
    * @return Número de planetas do sistema solar
  	*/
	private int numeroDePlanetas() {
		
		int resultado = 0;
		
		for (int i = 0; i < this.planetas.length; i++) {
			for (int j = 0; j < this.planetas[i].length; j++) {
				resultado ++;
			}
		}
		return resultado;
	}
	

	/**
    * Método que devolve true se o n-ésimo planeta deste sistema solar tem todas as 
	* propriedades referidas na lista props. A ordem pela qual são considerados os planetas
	* no sistema solar segue a direção de uma lagarta horizontal, que volta ao início
	* quando termina
	* @param n   Índice do planeta 
	* @param props   Lista de propriedades a verificar 
    * 
    * @return Retorna true ou false dependendo se o planeta tem ou não as propriedades
 	*/
	public boolean nEsimoTem(int n, List<Propriedade> props) {
	
		int maximo = numeroDePlanetas();
		
		while (n >= maximo) {
			n -= maximo;
		}
		
		Planeta planetaVerificar = null;
		int contador = -1;
		
		for (int i = 0; i < this.planetas.length; i++) {
			if (i%2 == 0 || i == 0) { // Se for par ou 0
				for (int j = 0; j < this.planetas[i].length; j++) {
					contador++;
					
					if (contador == n) {
						planetaVerificar = this.planetas[i][j];
					}
				}
			}else { // Se for ímpar
				for (int j = this.planetas[i].length - 1; j >= 0; j--) {
					
					contador++;
					
					if (contador == n) {
						planetaVerificar = this.planetas[i][j];
					}
				}
			}	
		}
		return planetaVerificar.temTodas(props);
	}
	

	/**
    * Método que devolve a propriedade que aparece mais vezes nos planetas do
	* sistema solar onde é aplicado o método
    * 
    * @return Retorna qual a propriedade mais frequente
 	*/
	public Propriedade maisFrequente(){

		Propriedade[] propriedades = Propriedade.values(); 
		int[] frequencia = this.quantosPorPropriedade();   
        
		Propriedade maisFrequente = propriedades[0];
        int maximo = 0;
		
        for (int i = 0; i < frequencia.length; i++) {
        	if(frequencia[i] > maximo) {
        		maximo = frequencia[i];
        		maisFrequente = propriedades[i];
        	}
        	
        }
        return maisFrequente;
	}	
		
	
	/**
	* Método que devolve que devolve a representação textual da instituição sobre a 
	* qual é aplicado o método 
	* 
	* @return Retorna a representação textual do planeta em forma de String
	*/
	public String toString() {
	
		StringBuilder resultado = new StringBuilder (this.nome() + "\n");

		for (int i = 0; i < this.planetas.length; i++) {
			for(int j = 0 ; j < this.planetas[i].length; j++) {
				resultado.append(this.planetas[i][j].toString());
			}
			resultado.append("\n");
		}
		return resultado.toString();
	}
}