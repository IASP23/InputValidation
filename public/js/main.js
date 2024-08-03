const formulario = document.getElementById("formulario");
const nombres = document.getElementById("nombres");
const apellidos = document.getElementById("apellidos");
const cedulaRUC = document.getElementById("cedulaRUC");
const telefono = document.getElementById("telefono");
const fechaNacimiento = document.getElementById("fechaNacimiento");
const salario = document.getElementById("salario");
const email = document.getElementById("email");
const contrasena = document.getElementById("contrasena");

const errorNombres = document.getElementById("errorNombres");
const errorApellidos = document.getElementById("errorApellidos");
const errorCedulaRUC = document.getElementById("errorCedulaRUC");
const errorTelefono = document.getElementById("errorTelefono");
const errorFechaNacimiento = document.getElementById("errorFechaNacimiento");
const errorSalario = document.getElementById("errorSalario");
const errorEmail = document.getElementById("errorEmail");
const errorContrasena = document.getElementById("errorContrasena");

// Eventos para restringir la entrada a solo letras y espacios
nombres.addEventListener("input", function () {
  validarEntrada(nombres);
});

apellidos.addEventListener("input", function () {
  validarEntrada(apellidos);
});

formulario.addEventListener("submit", (event) => {
  event.preventDefault();

  limpiarErrores();

  if (validarNombres(nombres)) {
    errorNombres.textContent =
      'El campo "Nombres" es obligatorio y solo debe contener letras.';
  }

  if (validarApellidos(apellidos)) {
    errorApellidos.textContent =
      'El campo "Apellidos" es obligatorio y solo debe contener letras.';
  }

  if (validarCedulaRUC(cedulaRUC)) {
    errorCedulaRUC.textContent =
      'El campo "Cédula/RUC" es obligatorio y debe tener el formato correcto.';
  }

  if (validarTelefono(telefono)) {
    errorTelefono.textContent =
      'El campo "Teléfono" es obligatorio y debe ser un número de teléfono válido.';
  }

  if (validarFechaNacimiento(fechaNacimiento)) {
    errorFechaNacimiento.textContent =
      'El campo "Fecha de nacimiento" es obligatorio y debe ser una fecha menor o igual a la actual.';
  }

  if (validarSalario(salario)) {
    errorSalario.textContent =
      'El campo "Salario" es obligatorio y debe ser un número mayor o igual al salario básico ($460).';
  }

  if (validarEmail(email)) {
    errorEmail.textContent =
      'El campo "Correo electrónico" es obligatorio y debe ser una dirección de correo electrónico válida.';
  }

  const mensajeErrorContrasena = validarContrasena(contrasena);
  if (mensajeErrorContrasena !== true) {
    errorContrasena.textContent = mensajeErrorContrasena;
  }

  if (!hayErrores()) {
    alert("Formulario Enviado");
    formulario.submit();
  }
});

function limpiarErrores() {
  errorNombres.textContent = "";
  errorApellidos.textContent = "";
  errorCedulaRUC.textContent = "";
  errorTelefono.textContent = "";
  errorFechaNacimiento.textContent = "";
  errorSalario.textContent = "";
  errorEmail.textContent = "";
  errorContrasena.textContent = "";
}

/* Validar entradas de solo letras y espacios */
function validarEntrada(input) {
  const valor = input.value;
  const regex = /^[a-zA-ZáéíóúÁÉÍÓÚ\s]*$/;

  if (!regex.test(valor)) {
    input.value = valor.replace(/[^a-zA-ZáéíóúÁÉÍÓÚ\s]/g, "");
  }
}

/* Uso de expresiones regulares */
function validarNombres(nombres) {
  return nombres.value.trim() === "";
}

function validarApellidos(apellidos) {
  return apellidos.value.trim() === "";
}

function validarCedulaRUC(cedulaRUC) {
  return !/^(?:[0-9]{10}|[0-9]{13})$/.test(cedulaRUC.value.trim());
}

function validarTelefono(telefono) {
  return !/^[0-9]{10}$/.test(telefono.value.trim());
}

function validarFechaNacimiento(fechaNacimiento) {
  if (fechaNacimiento.value.trim() === "") {
    return true;
  }
  const fechaActual = new Date();
  const fechaNacimientoDate = new Date(fechaNacimiento.value);
  return fechaNacimientoDate > fechaActual;
}

function validarSalario(salario) {
  const salarioValue = salario.value.trim();
  if (salarioValue === "") {
    return true;
  }
  const salarioNumber = parseFloat(salarioValue);
  return isNaN(salarioNumber) || salarioNumber <= 460;
}

function validarEmail(email) {
  return !/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/.test(email.value.trim());
}

function validarContrasena(contrasena) {
  const trimmedContrasena = contrasena.value.trim();

  // Validación de longitud
  if (trimmedContrasena.length < 6 || trimmedContrasena.length > 12) {
    return "La contraseña debe tener entre 6 y 12 caracteres al menos una letra mayúscula, una letra minúscula, un número y un carácter especial.";
  }

  // Validación de caracteres
  if (!/(?=.*\d)/.test(trimmedContrasena)) {
    return "La contraseña debe contener al menos un número.";
  }

  if (!/(?=.*[a-z])/.test(trimmedContrasena)) {
    return "La contraseña debe contener al menos una letra minúscula.";
  }

  if (!/(?=.*[A-Z])/.test(trimmedContrasena)) {
    return "La contraseña debe contener al menos una letra mayúscula.";
  }

  if (!/(?=.*\W)/.test(trimmedContrasena)) {
    return "La contraseña debe contener al menos un carácter especial.";
  }

  // Si pasa todas las validaciones, retorna true (contraseña válida)
  return true;
}

function hayErrores() {
  return (
    errorNombres.textContent !== "" ||
    errorApellidos.textContent !== "" ||
    errorCedulaRUC.textContent !== "" ||
    errorTelefono.textContent !== "" ||
    errorFechaNacimiento.textContent !== "" ||
    errorSalario.textContent !== "" ||
    errorEmail.textContent !== "" ||
    errorContrasena.textContent !== ""
  );
}
