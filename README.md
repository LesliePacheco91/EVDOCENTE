# Aplicación web para la automatización del proceso de evaluación docente en la Universidad Tecnológica del Mayab (EVDOCENTE)

## 📌 descripción

Esta aplicación permite a estudiantes, profesores y personal administrativo realizar evaluaciones mediante un formulario web. Los resultados se procesan automáticamente a través de operaciones matemáticas y se presentan de forma clara y comprensible.

La plataforma admite sesiones multiusuario, lo que permite a cada evaluador acceder a su perfil personalizado. En el caso del perfil del profesor, se añadió un módulo para la solicitud de restricción de horario, donde puede seleccionar los días y horarios en los que no podrá asistir. Esta funcionalidad está disponible únicamente para profesores por asignatura (horarios variables) y no aplica para profesores de tiempo completo.

## 📊 Logros
La plataforma ha incrementado la eficiencia del proceso en un 60%, eliminando completamente el error humano y centralizando la información en una base de datos, lo que permitió reemplazar los extensos formatos en Excel utilizados anteriormente. Los resultados se generan en tiempo real, y al concluir el periodo de evaluación, el sistema produce automáticamente un formato listo para imprimirse y entregarse al profesor evaluado, incluyendo sus áreas de oportunidad.

## 🛠️ Aspectos tecnicos
La aplicación fue planeada y desarrollada con el objetivo de modernizar y hacer más eficiente el proceso tradicional de evaluación docente en la universidad. Para ello, se realizó un estudio previo sobre la forma en que se llevaba a cabo dicho proceso, asegurando que la nueva solución se alineara con los lineamientos institucionales establecidos.

El desarrollo se llevó a cabo utilizando los lenguajes ![PHP](https://img.shields.io/badge/php-%23777BB4.svg?style=flat&logo=php&logoColor=white) para la lógica del sistema, ![MySQL](https://img.shields.io/badge/mysql-%2300000f.svg?style=flat&logo=mysql&logoColor=white) para la gestión de bases de datos y ![Bootstrap](https://img.shields.io/badge/bootstrap-%23563D7C.svg?style=flat&logo=bootstrap&logoColor=white) como plantilla para el diseño responsivo de la interfaz. Se implementó el patrón ![MVC](https://img.shields.io/badge/Modelo--Vista--Controlador-MVC-blueviolet?style=flat) , empleando el paradigma de ![POO](https://img.shields.io/badge/POO-Paradigm-6A1B9A?style=flat&logo=circleci&logoColor=white) y realizando las consultas a la base de datos mediante PDO (PHP Data Objects) ![PDO](https://img.shields.io/badge/PHP--PDO-8892BF?style=flat&logo=php&logoColor=white) para asegurar mayor seguridad y eficiencia en el manejo de datos.

## 📁 perfiles desarrollados

### perfil alumno

![Perfil del alumno](DOCUMENTOS/img/EV_Docente_11.png)


### profesor profesor
![Lista de evaluaciones del profesor](DOCUMENTOS/img/EV_Docente_13.png)

#### Modulo de restricción de horario
![Vista nueva restriccion](DOCUMENTOS/img/EV_Docente_12.png)
![Lista de restricciones](DOCUMENTOS/img/EV_Docente_17.png)


### perfil admin
![Vista inicio](DOCUMENTOS/img/EV_Docente_10.png)
![Vista principal](DOCUMENTOS/img/EV_Docente_14.png)
![Nueva evaluacion](DOCUMENTOS/img/EV_Docente_15.png)
![modificar_fecha](DOCUMENTOS/img/EV_Docente_16.png)
![Lista de cuatrimestres](DOCUMENTOS/img/EV_Docente_19.png)
![grupos](DOCUMENTOS/img/EV_Docente_18.png)
![Detalle del grupo](DOCUMENTOS/img/EV_Docente_20.png)
![Carga Académica](DOCUMENTOS/img/EV_Docente_4.png)
![Lista de restrucciones aceptadas](DOCUMENTOS/img/EV_Docente_7.png)
![Plan de observación docente](DOCUMENTOS/img/EV_Docente_8.png)
![Resultados](DOCUMENTOS/img/EV_Docente_9.png)


