export interface ICCProject {
  status: "draft" | "publish" | "delete" | "archive",
  title: string,
  description: string,
  dataEntity: ICCCDataEntity[],
}

export interface ICCCDataEntity {
  entityName: string
  entitySections: ICCCDataSection[]
  description: string
  hasLifeCycleOption: boolean
}

export interface ICCCDataSection {
  name: string
  description: string
  id: string
  item: ICCCDataItem[]
}

export interface ICCCDataItem {
  name: string
  donnes: number
  unit: string
  tco2e: number
  yearLifeCycle: number
  description: string
  srcfr: string
}

export interface IUserEditedProject extends ICCProject {
  dataEntity: IUserEditedDataEntity[],
}

export interface IUserEditedDataEntity extends ICCCDataEntity {
  entitySections: IUserEditedDataSection[]
}

export interface IUserEditedDataSection extends ICCCDataSection {
  item: IUserEditedDataItem[]
}

export interface IUserEditedDataItem extends ICCCDataItem {
  edited: boolean
}
