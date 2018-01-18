

function remplace_comma_to_point(str)
{
	// remplaza la coma por el punto para poder hacer calulos con jquery
	return str.toString().replace(/\,/g, '.');
}



function remplace_point_to_comma(str)
{
	// remplaza la coma por el punto para poder hacer calulos con jquery
	return str.toString().replace(/\./g, ',');
}