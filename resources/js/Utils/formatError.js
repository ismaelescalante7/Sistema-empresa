export default function Errors () {
    function getErrorMessage (errorMessage) {

      if (typeof errorMessage === 'object') {
        return errorMessage[0]
      } 
      return errorMessage
    }

    function getBooleanError(errorMessage) {

        if (errorMessage === undefined || errorMessage === null) {
          return false
        } 
        return true
      }
  
    return {
      getErrorMessage,
      getBooleanError
    }
  }
  