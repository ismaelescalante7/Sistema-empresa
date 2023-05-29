const getDepartamentosByProvinciaId = (provinciaId, departamentos) => {
  return departamentos.filter(departamento => departamento.provincia_id === parseInt(provinciaId))
}

const getLocalidadesByDepartamentoId = (departamentoId, localidades) => {
  return localidades.filter(localidad => localidad.departamento_id === parseInt(departamentoId))
}

export {
  getDepartamentosByProvinciaId,
  getLocalidadesByDepartamentoId
}
