pipeline
{
	agent any
	environment
	{
	    def USERNAME = "El usuario actual: ${env.USERNAME}"
	}
	stages
	{
	    stage("Dias de la semana")
	    {
	        steps
	        {
	            
	            script
	            {
	                def dia = new Date().getDay()
			print "Día de la semana: "+ dia
	                println "Usuario de la máquina: " + USERNAME

	                if (dia == 2) {
				println "Holaa..."
				git branch: "main", url: "https://github.com/Ripper2021/CICD_Jenkins.git"
		    	} else if (dia == 3) {
				println "Hoy hace un bonito día..."
		    	} else if (dia == 4) {
				println "clonamos repo..."
				git branch: "main", url: "https://github.com/jmoratalla/Git01.git"
		    	} else {
				println "Hoy descanso..."
		    	}
	                
	                
	            }
	        }
	        
	    }
	}
    
}
