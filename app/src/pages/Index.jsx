import React from 'react'

import LoadingDisplay from '../components/LoadingDisplay'
import VideoEmbed from '../components/VideoEmbed'

/** @typedef {import('../api/getPreview').Preview} Preview */
import getPreview from '../api/getPreview'

import getEmbedLink from '../utils/getEmbedLink'

/**
 * Index page
 *
 * @author Kieran Knowles
 * @generated Github copilot was used to assist in writing this code
 */
export default function Index () {
  const [status, setStatus] = React.useState('loading')
  /** @type {[Preview, function (Preview): void]} */
  const [preview, setPreview] = React.useState(null)

  // TODO: Cache the response when reloading the page
  React.useEffect(() => {
    getPreview(1)
      .then(preview => {
        setPreview(preview[0])
        setStatus('done')
      })
      .catch(err => {
        console.error(err)
        setStatus('error')
      })
  }, [])

  return (
    <main>
      <h1>CHI 2023</h1>
      <LoadingDisplay status={status} />
      {preview && <h2>{preview.title}</h2>}
      {preview && <VideoEmbed link={getEmbedLink(preview.preview_video)} />}
    </main>
  )
}
