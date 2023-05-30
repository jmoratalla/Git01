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
	                println USERNAME
	                if ( dia == "1" ) {
	                	println "Hoy es lunes y no hacemos nada"
	                }
	                
	                
	            }
	        }
	        
	    }
	}
    
}
