@extends('layouts.app')

@section('content')

<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

<h3>Nr:{{$concesiune->numar}}/{{$concesiune->tarif->an}} Durata:{{$concesiune->durata}} ani , tip:{{$concesiune->tip->nume}}</h3>
<p>Cimitir: {{$concesiune->loc->parcela->cimitir->nume}} Parcela: {{$concesiune->loc->parcela->numar}} Loc: {{$concesiune->loc->numar}}</p>
<table class="table table-condensed">
                      @foreach($concesiune->persoane as $persoana)
                      <tr>
                        <td>{{$persoana->nume}}</td>
                        <td>{{$persoana->prenume}}</td>
                         <td>{{$persoana->CNP}}</td>
                      </tr>
                      @endforeach      
</table>
<h2>Rate:</h2>
	@if ($concesiune->rate->count() > 0)
	<table class="table table-condensed">
		
			@foreach ($rate as $rata)
				<tr>
				<td> {{$rata->tarif->an}} </td>
				<td> {{$rata->tarif->redeventa}} </td>
				<td> {{$rata->tarif->intretinere}} </td>
				<td> {{$rata->tarif->intretinere+$rata->tarif->redeventa}} </td>
				<td> {{$rata->plati->sum('suma')}}</td>
				<td> {{$rata->tarif->intretinere+$rata->tarif->redeventa-$rata->plati->sum('suma')}} </td>
				<td> <a class="btn btn-small btn-success" href="{{ route ('rate.edit' , $rata->id) }}">Detalii</a></td>
        	  	<td><a class="btn btn-small btn-success" href="{{ route ('rate.show' , $rata->id) }}">Plateste</a></td>
				</tr>
			@endforeach
		
	</table>

		@else 
		<p>
			Nu exista nicio rata!			
		</p>
	@endif
<div>
    <p>Total de plata: {{$restDePlata}}</p>
    <a class="btn btn-info" href="{{ route('rate.create') }}">Plata grup</a>
 </div>
</div>
{!! $rate->render() !!}
 
@endsection