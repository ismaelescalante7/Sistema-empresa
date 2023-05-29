import dayjs from 'dayjs'

const dateFormat = (payload, format = 'DD/MM/YYYY') => {
  return dayjs(payload).format(format)
}

const uppercase = (payload) => {
  if (typeof payload !== 'string') return payload

  return payload.toUpperCase()
}

export {
  dateFormat,
  uppercase
}
