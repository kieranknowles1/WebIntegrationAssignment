import React from 'react'

import LoadingDisplay from '../components/LoadingDisplay'
import VideoEmbed from '../components/VideoEmbed'

/** @typedef {import('../api/getPreview').Preview} Preview */
import getEmbedLink from '../utils/getEmbedLink'

import DataFetcherContext from '../contexts/DataFetcherContext'

/**
 * Index page
 *
 * @author Kieran Knowles
 * @generated Github copilot was used to assist in writing this code
 */
export default function Index () {
  const fetcher = React.useContext(DataFetcherContext)

  /** @type {[Preview, function (Preview): void]} */
  const [preview, setPreview] = React.useState(null)

  React.useEffect(() => {
    fetcher.preview.get()
      .then(preview => {
        setPreview(preview)
      })
      .catch(err => {
        console.error(err)
      })
  }, [])

  return (
    <main>
      <h1>CHI 2023</h1>
      <LoadingDisplay status={fetcher.preview.status} />
      {preview && <h2>{preview.title}</h2>}
      {preview && <VideoEmbed link={getEmbedLink(preview.preview_video)} />}
    </main>
  )
}
