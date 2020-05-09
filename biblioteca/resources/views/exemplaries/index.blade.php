@extends('layouts.app')

@section('title', 'Exemplares')

@section('sidebar')
    @parent
@endsection

@section('content')

<div class="container">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
						<h2><b>Exemplares</b></h2>
					</div>
					<div class="col-sm-6">
						<a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Adicionar</span></a>					
					</div>
				</div>
				@if (session('status'))
					<div class="alert alert-success mt-3">
						{{ session('status') }}
						<button type="button" class="close" data-dismiss="alert">×</button>
					</div>
				@endif
				@if (session('error'))
					<div class="alert alert-danger mt-3">
						{{ session('error') }}
						<button type="button" class="close" data-dismiss="alert">×</button>
					</div>
				@endif
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th class="w-auto">Data de aquisição</th>
						<th class="w-auto">Situação</th>
						<th class="w-auto">Ações</th>
                    </tr>
                </thead>
                <tbody>
					@foreach($exemplaries as $exemplary)
                    <tr>
                        <td>{{ date('d/m/Y', strtotime($exemplary->acquisition_date)) }}</td>
						<td>
							@if($exemplary->situation === 0)
								Disponível
							@else
								Indisponível
							@endif
						</td>
                        <td>
                            <a href="#deleteEmployeeModal{{ $exemplary->id }}" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Excluir">&#xE872;</i></a>
                        </td>
					</tr>
					<!-- Delete Modal HTML -->
					<div id="deleteEmployeeModal{{ $exemplary->id }}" class="modal fade">
						<div class="modal-dialog">
							<div class="modal-content">
								<form method="POST" action="{{ route('exemplaries.destroy', $exemplary->id) }}">
									@csrf	
									@method('DELETE')
									<div class="modal-header">						
										<h4 class="modal-title">Excluir Exemplar</h4>
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									</div>
									<div class="modal-body">					
										<p>Você tem certeza que deseja excluir esse registro?</p>
										<p class="text-warning"><small>Essa ação não pode ser revertida.</small></p>
									</div>
									<div class="modal-footer">
										<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
										<input type="submit" class="btn btn-danger" value="Excluir">
									</div>
								</form>
							</div>
						</div>
					</div>
					@endforeach
                </tbody>
            </table>
			<div class="clearfix">
				<div class="hint-text"><b>{{ $exemplaries->currentPage() }}</b> de <b>{{ $exemplaries->lastPage() }}</b></div>
				{{ $exemplaries->links() }}
            </div>
        </div>
    </div>
	<!-- Add Modal HTML -->
	<div id="addEmployeeModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form method="POST" action="{{ route('exemplaries.store') }}">
					@csrf
					@method('POST')
					<div class="modal-header">						
						<h4 class="modal-title">Adicionar Exemplar</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">					
						<div class="form-group has-feedback {{ $errors->has('acquisition_date') ? 'has-error' : '' }}">
							<label>Data de aquisição</label>
							<input type="hidden" name="works_id" class="form-control" value="{{ $id }}">
							<input type="date" name="acquisition_date" value="{{ $date }}" class="form-control" required>
							@if ($errors->has('acquisition_date'))
                            <span class="help-block text-danger">
                                <strong>{{ $errors->first('acquisition_date') }}</strong>
                            </span>
                    		@endif
						</div>
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
						<input type="submit" class="btn btn-success" value="Salvar">
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection