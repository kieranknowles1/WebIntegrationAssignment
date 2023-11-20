import React from 'react'

import Country from '../components/Country'
import getCountries from '../api/getCountries'

/**
 * Countres page
 *
 * @author Kieran Knowles
 * @generated GitHub Copilot was used to assist in writing this code
 */
function Countres () {
  const [countries, setCountries] = React.useState([])
  const [error, setError] = React.useState(false)
  const [loading, setLoading] = React.useState(true)

  // TODO: Cache the response when reloading the page
  React.useEffect(() => {
    getCountries()
      .then(countries => {
        console.log(countries)
        setCountries(countries.map((country, index) => <Country key={index} name={country} />))
      })
      .catch(err => {
        console.error(err)
        setError(true)
      })
      .finally(() => {
        setLoading(false)
      })
  }, [])

  return (
    <div>
      <h1>Countres</h1>
      {loading && <p>Loading...</p>}
      {error && <p>There was an error loading the countries. See the console for details.</p>}
      <ul>{countries}</ul>
    </div>
  )
}

export default Countres
