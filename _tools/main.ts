import {IUserEditedProject} from "./typeFromWebApp/IUser.ts"
import exit = Deno.exit

const input = Deno.args[0]

if(input === undefined || input.length < 1) {
 console.error('need input data file')
  exit()
}

const text = await Deno.readTextFile(input)

const data = JSON.parse( JSON.parse(text) ) as IUserEditedProject



data.dataEntity.forEach( async (entity, index) => {

  let kirbyDBText = ''
  const directoryTitle = `${index + 1}_${entity.entityName
    .toLowerCase()
    .trim()
    .normalize('NFD')
    .replace(/[\u0300-\u036f]/g, '')
    .replace(/[^\w\s-]/g, '')
    .replace(/[\s_-]+/g, '-')
    .replace(/^-+|-+$/g, '')}`

  await Deno.mkdir(`output/${directoryTitle}/`, {
    recursive: true,
  })

  kirbyDBText += kirbyDBFile_entityText({
    text: entity.description,
    lifeCycleIsActive: entity.hasLifeCycleOption,
    title: entity.entityName
  })

  for (const entitySection of entity.entitySections) {

    kirbyDBText += kirbyDBFile_entitySectionText({
      name: entitySection.name,
      description: entitySection.description,
    })

    for (const itemOfEntitySection of entitySection.item) {
      kirbyDBText += kirbyDBFile_itemOfEntitySection({
        name: itemOfEntitySection.name,
        description: itemOfEntitySection.description,
        donnes: itemOfEntitySection.donnes,
        srcfr: itemOfEntitySection.srcfr,
        tco2e: itemOfEntitySection.tco2e,
        unit: itemOfEntitySection.unit,
      })
    }
  }

  Deno.writeTextFile(`output/${directoryTitle}/default.txt`, kirbyDBText)
})


function kirbyDBFile_entityText({title, text, lifeCycleIsActive}: {
  title: string,
  text: string,
  lifeCycleIsActive: boolean
}): string {
return `Title: ${title}

----

Text: ${text}

----

Lifecycleisactive: ${lifeCycleIsActive}

----

Item:`
}



function kirbyDBFile_entitySectionText({name, description}: {
  name: string,
  description: string
}): string {
  return `
-
  name: ${name}
  description: ${description}
  item:`
}

function kirbyDBFile_itemOfEntitySection({name, description, donnes, unit, tco2e, srcfr,}: {
  name: string,
  description: string,
  donnes: number,
  unit: string,
  tco2e: number,
  srcfr: string,
}): string {
  return `
    -
      name: ${name}
      description: ${description}
      donnes: ${donnes}
      unit: ${unit}
      tco2e: ${tco2e}
      srcfr: ${srcfr}
`
}
