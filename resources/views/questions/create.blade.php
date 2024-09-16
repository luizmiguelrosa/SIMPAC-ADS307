<form action="{{ route('questions.store') }}" method="POST">
    @csrf

    <div class="form-group mb-3">
        <label for="evaluative_model_id">Modelo Avaliativo</label>
        <select class="form-control @error('evaluative_model_id') is-invalid @enderror" id="evaluative_model_id" name="evaluative_model_id" required>
            <option value="">Selecionar modelo avaliativo</option>
            @foreach($evaluativeModels as $model)
                <option value="{{ $model->id }}">{{ $model->model_name }}</option>
            @endforeach
        </select>
        @error('evaluative_model_id')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div id="questions-container">
        <h3>Perguntas</h3>
        @for ($i = 1; $i <= 10; $i++)
            <div class="form-group mb-3">
                <label for="question_{{ $i }}">Pergunta {{ $i }}</label>
                <input type="text" class="form-control @error('questions.' . ($i - 1)) is-invalid @enderror" id="question_{{ $i }}" name="questions[]" placeholder="Pergunta {{ $i }}">
                @error('questions.' . ($i - 1))
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        @endfor
    </div>

    <button type="submit" class="btn btn-primary mt-3">Salvar Perguntas</button>
</form>
