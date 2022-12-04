const inputFoto = document.querySelector(".input-foto");
const imagem = document.querySelector(".mostrar-imagem");
const textoInput = "Documento com foto";
imagem.innerHTML = textoInput;

inputFoto.addEventListener("change", function(e) {
const inputSelecionado = e.target;
const foto = inputSelecionado.files[0];

if (foto) {
    const leitor = new FileReader();

    leitor.addEventListener("load", function(e) {
    const LeitorAtivado = e.target;

    const img = document.createElement("img");
    img.src = LeitorAtivado.result;
    img.classList.add("mostrar-imagem");

    imagem.innerHTML = "";
    imagem.appendChild(img);
    });

    leitor.readAsDataURL(foto);
} else {
    imagem.innerHTML = textoImagem;
}
});