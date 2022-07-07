import java.util.Arrays;
import java.util.List;

/**
 * Programa para testar as classes Planeta e SistemaSolar feitas
 * pelos alunos na Fase 2 do trabalho de PCO
 * 
 * @author minunes
 * @date Novembro 2021
 */
public class PCOFase2 {

	/**
	 * Comeca por criar 3 listas de propriedades que serao depois usadas para
	 * a criacao dos planetas de um sistema solar.
	 * Cria um planeta e invoca dois metodos sobre esse objeto. 
	 * Cria um array bi-dimensional de planetas que nao e' uma matriz e invoca
	 * o método static universoValido da classe SistemaSolar.
	 * Cria uma matriz de planetas e invoca o método static universoValido
	 * da classe SistemaSolar. De seguida usa a matriz para criar um sistema solar.
	 * Invoca varios me'todos sobre esse sistema solar.
	 * Cria um verificador para verificar propriedades sobre esse mesmo sistema
	 * solar.
	 * @param args Nao utilizado
	 */
     public static void main(String[] args) {

		List<Propriedade> props1 = Arrays.asList(new Propriedade[] 
				{Propriedade.HAS_WATER,Propriedade.FRIENDLY});
		List<Propriedade> props2 = Arrays.asList(new Propriedade[] 
				{Propriedade.BREATHABLE,Propriedade.HAS_WATER,Propriedade.HAS_LIGHT});
		List<Propriedade> props3 = Arrays.asList(new Propriedade[] 
				{Propriedade.FRIENDLY,Propriedade.BREATHABLE});

		Planeta jovian = new Planeta("Pasiphae", props1);
		System.out.println(jovian.toString());
		System.out.println();
		
        // Devem dar true, false, true
		System.out.println("O planeta Pasiphae tem a propriedade FRIENDLY? " + 
		                   jovian.temPropriedade(Propriedade.FRIENDLY));
		System.out.println("O planeta Pasiphae tem a propriedade BREATHABLE? " + 
		                   jovian.temPropriedade(Propriedade.BREATHABLE));
		System.out.println("O planeta Pasiphae tem as propriedades " + props1.toString() + "? " + 
                           jovian.temTodas(props1)); 
		System.out.println();
		
		Planeta[][] myPlanetas = umMauSistema(props1);		
		// Deve dar false
		System.out.println("Universo e' valido? " + SistemaSolar.universoValido(myPlanetas));

		myPlanetas = novoSistema(props1, props2, props3);
		// Deve dar true
		System.out.println("Universo e' valido? " + SistemaSolar.universoValido(myPlanetas));
		System.out.println();

		SistemaSolar mySolar = new SistemaSolar("Tarvos",myPlanetas);
		System.out.println(mySolar.toString());
		System.out.println();
		
		List<Propriedade> props4 = Arrays.asList(new Propriedade[] 
				{Propriedade.HAS_LIGHT,Propriedade.BREATHABLE});

		System.out.println("O planeta na posicao 2 satisfaz " + props4.toString() + "? " +
		                    mySolar.nEsimoTem(2, props4));   // Deve dar false
		System.out.println("O planeta na posicao 4 satisfaz " + props4.toString() + "? " +
		                    mySolar.nEsimoTem(4, props4));   // Deve dar true

		List<String> comProps = mySolar.comPropriedades(props2);
		System.out.println();
		System.out.println("Planetas com as propriedades " + props2.toString() + ":");
		// Deve dar Paaliaq Amalthea Ananke Kallichore Eukelade
		for(String s : comProps) {
			System.out.print(s + " ");
		}
		System.out.println();

		int[] quantos = mySolar.quantosPorPropriedade();
		System.out.println();
		System.out.println("Quantos planetas satisfazem cada propriedade:");
		// Deve dar HAS_WATER: 8   HAS_LIGHT: 5   FRIENDLY: 7   BREATHABLE: 9
		for(int i = 0 ; i < quantos.length ; i++) {
			System.out.print(Propriedade.values()[i] + ": " + quantos[i] + "   ");
		}
		System.out.println();
		// Deve dar BREATHABLE
		System.out.println("Propriedade mais frequente no sistema: " + mySolar.maisFrequente());
				
		Verificador myInspetor = new Verificador(mySolar);

		// Devem dar true, true e false
		verificaSatisfacao("12:HAS_WATER,FRIENDLY;2:FRIENDLY;2:HAS_WATER,BREATHABLE,HAS_LIGHT;5:HAS_WATER",
				           myInspetor);
		verificaSatisfacao("7:FRIENDLY,BREATHABLE;18:BREATHABLE,HAS_WATER,HAS_LIGHT", 
				           myInspetor);
		verificaSatisfacao("1:HAS_WATER,BREATHABLE,HAS_LIGHT;3:HAS_LIGHT,BREATHABLE;4:HAS_WATER;3:FRIENDLY",
				           myInspetor);
	}

	/**
	 * Verifica se um dado requisito e' satisfeito pelo sistema solar associado
	 * a um dado verificador e escreve o resultado no standard output
	 * @param requis O requisito, na forma
	 * @param inspetor O verificador que vai proceder 'as verificacoes
	 * @requires requis != null && inspetor != null
	 */
	private static void verificaSatisfacao(String requis, Verificador inspetor) {
		System.out.println();
		System.out.println("O sistema satisfaz os requisitos " + requis + "? " +
				           inspetor.verificaPropriedade(requis));
	}
	
	/**
	 * Constroi e devolve uma matriz de planetas
	 * @param props1 Uma lista contendo propriedades
	 * @param props2 Uma lista contendo propriedades
	 * @param props3 Uma lista contendo propriedades
	 * @requires props1 != null && props2 != null && props3 != null
	 * @return Uma matriz com 4 x 3 planetas
	 */
	private static Planeta[][] novoSistema(List<Propriedade> props1, List<Propriedade> props2, 
			                               List<Propriedade> props3) {
		Planeta[][] result = { 
				{ new Planeta("Pasiphae", props1),   // HAS_WATER,FRIENDLY
					new Planeta("Paaliaq", props2),  // BREATHABLE,HAS_WATER,HAS_LIGHT
					new Planeta("Kalliope", props1)  // HAS_WATER,FRIENDLY
				} ,
				{ new Planeta("Linus", props3),      // FRIENDLY,BREATHABLE
					new Planeta("Amalthea", props2), // BREATHABLE,HAS_WATER,HAS_LIGHT
					new Planeta("Ganymede", props3)  // FRIENDLY,BREATHABLE
				} ,
				{ new Planeta("Ananke", props2),     // BREATHABLE,HAS_WATER,HAS_LIGHT
					new Planeta("Eurydome", props3), // FRIENDLY,BREATHABLE
					new Planeta("Orthosie", props1)  // HAS_WATER,FRIENDLY
				} ,
				{ new Planeta("Kallichore", props2), // BREATHABLE,HAS_WATER,HAS_LIGHT
					new Planeta("Cyllene", props3),  // FRIENDLY,BREATHABLE
					new Planeta("Eukelade", props2)  // BREATHABLE,HAS_WATER,HAS_LIGHT
				}
		};

		return result;
	}

	/**
	 * Constroi e devolve um array bi-dimensional de planetas que nao e'
	 * uma matriz
	 * @param props Uma lista contendo propriedades
	 * @requires props != null
	 * @return Um array bi-dimensional de planetas que nao e' uma matriz
	 */
	private static Planeta[][] umMauSistema(List<Propriedade> props) {
		Planeta[][] result = { 
				{ new Planeta("Pasiphae", props),
					new Planeta("Paaliaq", props),
				} ,
				{ new Planeta("Linus", props),
				} ,
				{ new Planeta("Ananke", props),
				  new Planeta("Eurydome", props),
				  new Planeta("Orthosie", props)
				} ,
		};
		return result;
	}

}
