import React from 'react'

import Country from '../components/Country'
import LoadingDisplay from '../components/LoadingDisplay'
import getCountries from '../api/getCountries'

/**
 * Countres page
 *
 * @author Kieran Knowles
 * @generated GitHub Copilot was used to assist in writing this code
 */
function Countres () {
  const [countries, setCountries] = React.useState([])
  const [status, setStatus] = React.useState('loading')

  // TODO: Cache the response when reloading the page
  React.useEffect(() => {
    getCountries()
      .then(countries => {
        console.log(countries)
        setCountries(countries.map((country, index) => <Country key={index} name={country} />))
        setStatus('done')
      })
      .catch(err => {
        console.error(err)
        setStatus('error')
      })
  }, [])

  return (
    <div>
      <h1>Countres</h1>
      <LoadingDisplay status={status} />
      <ul>{countries}</ul>
    </div>
  )
}

export default Countres
