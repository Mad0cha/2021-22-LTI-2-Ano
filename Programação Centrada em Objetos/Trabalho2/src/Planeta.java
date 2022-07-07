import java.util.List;
import java.util.ArrayList;

/**
* @author MadalenaRodrigues_55853, PedroAlmeida_56897, RómuloNogueira_56935
* @date Novembro 2021
*/

public class Planeta {

	// Variáveis da instância
	private String nome;
	private List<Propriedade> props;
	
	/**
	* Construtor que inicializa um novo Planeta cujo nome é o passado no argumento nome, 
	* e cujas propriedades são as contidas na lista props
	* 
	* @param nome   nome do novo Planeta
	* @param props   lista de propriedades do novo Planeta
	*/
	public Planeta(String nome, List<Propriedade> props){
		
		this.nome = nome;
		this.props = new ArrayList<Propriedade>(props);
	}
	

	/**
	* Método que devolve o nome de um Planeta
	* 
	* @return Retorna o nome do Planeta sobre o qual se chama o método
	*/
	public String nome () {
	
		return this.nome;
	}
	
	
	/**
	* Método que devolve true se o planeta sobre o qual é aplicado tem a propriedade passada 
	* como argumento
	* 
	* @param propriedade   propriedade a verificar se existe no Planeta 
	* @return Retorna true ou false dependendo da existência da propriedade na lista de 
	* propriedades do Planeta
	*/
    public boolean temPropriedade(Propriedade propriedade) {
        
		return this.props.contains(propriedade);
    }

	
	/**
	* Método que devolve true se o planeta sobre o qual é aplicado tem todas as propriedades 
	* contidas na lista de propriedades passada como argumento
	* 
	* @param propriedades   lista de propriedades a verificar no Planeta 
	* @return Retorna true ou false dependendo se o Planeta tem ou não todas as propriedades
	* indicadas
	*/
    public boolean temTodas(List<Propriedade> propriedades) {

        for (Propriedade p : propriedades ) {
            if (!this.props.contains(p)) {
                return false;
            }
        }
        return true;
    }

	
	/**
	* Método que devolve a representação textual do planeta sobre o qual é aplicado
	* 
	* @return Retorna a representação textual do planeta em forma de String
	*/
	public String toString() {
		
		String nome = this.nome();
		StringBuilder resultado = new StringBuilder(nome + ": ");
		
		for (Propriedade prop : this.props) {
			resultado.append(prop.name() + " ");
		}
		
		return resultado.toString();
	}
}
