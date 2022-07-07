import java.util.ArrayList;
import java.util.List;

/**
 * As instancias desta classe representam verificadores de 
 * requisitos para um dado sistema solar 
 * 
 * @author minunes
 * @date Novembro 2021
 */
public class Verificador {
	// O sistema solar sobre o qual os requisitos sao verificados
	private SistemaSolar solar;

	/**
	 * Define o sistema solar sobre o qual o verificador trabalhara'
	 * @param sistema O sistema solar 
	 * @requires sistema != null
	 */
	public Verificador(SistemaSolar sistema) {
		this.solar = sistema;
	}

	/**
	 * O sistema solar associado a este verificador satisfaz uns dados
	 * requisitos?
	 * @param requisitos A string contendo os requisitos a verificar
	 * @requires requisitos e' da forma X1:s1;X2:s2;...;Xn:sn
	 *           - em que Xi representa um valor inteiro positivo 
	 *           - em que cada si e' da forma p1,...,pn sendo pi o nome de 
	 *             uma propriedade
	 *             
	 * @return true se o sistema solar associado a este verificador satisfaz
	 *              os requisitos dados como parametro
	 *         false caso contrario
	 */
	public boolean verificaPropriedade(String requisitos) {
		String[] partes = requisitos.split(";");
		int currentPos = 0;
		boolean result = true;
		
		for(int i = 0 ; i < partes.length && result ; i++) {
			int posDelta = partes[i].indexOf(":");
			int delta = Integer.parseInt(partes[i].substring(0,posDelta)); 
			
			String requisito = partes[i].substring(posDelta + 1);
			currentPos += delta;
			//System.out.println(requisito);
			//System.out.println(currentPos);
			result = verifica(currentPos, requisito);
			//System.out.println(result);
		}		
		return result;
	}

	/**
	 * O planeta que se encontra numa dada posicao do sistema solar associado 
	 * a este verificador satisfaz umas dadas propriedades?
	 * @param posi A posicao do planeta sobre o qual devem ser verificadas
	 *             as propriedades dadas
	 * @param prop As propriedades a verificar
	 * @requires posi >= 0 && prop != null
	 * @return true se o planeta que se encontra na posicao posi do sistema solar 
	 *              associado a este verificador satisfaz as propriedades em prop
	 *         false caso contrario
	 */
	private boolean verifica(int posi, String prop) {
		String[] auxiliar = prop.split(",");
		List<Propriedade> propsReq = new ArrayList<Propriedade>();
		// Propriedades a partir de Strings
		for(int i = 0 ; i < auxiliar.length ; i++) {
			propsReq.add(Propriedade.valueOf(auxiliar[i]));
		}
		//System.out.println(propsReq);
		return this.solar.nEsimoTem(posi, propsReq);
	}
}

