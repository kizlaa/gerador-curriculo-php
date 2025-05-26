$(function() {
  $('#nascimento').on('change', function() {
    const dataNasc = new Date(this.value);
    const hoje = new Date();
    let idade = hoje.getFullYear() - dataNasc.getFullYear();
    const m = hoje.getMonth() - dataNasc.getMonth();
    if (m < 0 || (m === 0 && hoje.getDate() < dataNasc.getDate())) {
      idade--;
    }
    $('#idade').val(idade);
  });

  $('#add-formacao').on('click', function() {
    const novo = $('.formacao-item').first().clone();
    novo.find('input').val('');
    $('#formacoes').append(novo);
  });

  $('#add-experiencia').on('click', function() {
    const novo = $('.experiencia-item').first().clone();
    novo.find('input').val('');
    $('#experiencias').append(novo);
  });

  $('#add-habilidade').on('click', function() {
    const novo = $('.habilidade-item').first().clone();
    novo.find('input').val('');
    $('#habilidades').append(novo);
  });

  $('#add-referencia').on('click', function() {
    const novo = $('.referencia-item').first().clone();
    novo.find('input').val('');
    $('#referencias').append(novo);
  });
});
