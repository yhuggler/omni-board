export class Log {
    
    public logId: number;
    public loggingLevel: string;
    public message: string;
    public client: string;
    public ipAddress: string;
    public requestMethod: string;
    public requestUri: string;
    public createdAt: number;


    constructor(logId: number, loggingLevel: string, message: string,
        client: string, ipAddress: string, requestMethod: string, 
        requestUri: string, createdAt: number) {

        this.logId = logId;
        this.loggingLevel = loggingLevel;
        this.message = message;
        this.client = client;
        this.ipAddress = ipAddress;
        this.requestMethod = requestMethod;
        this.requestUri = requestUri;
        this.createdAt = createdAt;
    }
}
