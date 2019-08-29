import {AuthKey} from './authkey';

export class Server {
  public serverId: number;
  public friendlyName: string;
  public description: string;
  public authKey: AuthKey;

  constructor(serverId: number, friendlyName: string, description: string, authKey: AuthKey) {
    this.serverId = serverId;
    this.friendlyName = friendlyName;
    this.description = description;
    this.authKey = authKey;
  }
}
