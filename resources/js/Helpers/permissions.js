const checkPermissions = (shared, permissionList) => {
  console.log(shared)
  return shared.props.auth.permissions
    .some(
      item => permissionList.some(value => item.name === value)
    )
}

const hasPermission = (shared, permission) => {
  console.log(shared, permission)
  return shared.props.auth.permissions
    .some(item => item.name === permission)
}

export {
  checkPermissions,
  hasPermission
}
