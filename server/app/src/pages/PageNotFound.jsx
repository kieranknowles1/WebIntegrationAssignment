import React from 'react'

import blep from '../assets/blep.jpeg'
import cookie from '../assets/cookie.jpeg'

/**
 * 404 page for the application
 *
 * @author Kieran Knowles
 * @generated Github copilot was used to assist in writing this code
 */
export default function PageNotFound () {
  return (
    <div>
      <h1>404: Page not found.</h1>
      <img src={blep} alt='Millie the cat blepping' />
      <figcaption>Millie is very confused why you&apos;re here. (Image credit: Kieran Knowles i.e. myself)</figcaption>
      <p>I have 2 cats, here&apos;s the cat tax for Cookie.</p>
      <img src={cookie} alt='Cookie the cat' />
    </div>
  )
}
